<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Registration;
use App\Models\StudentDevice;
use App\Models\StudentDeviceInventory;
use App\Models\StudentDeviceType;
use App\Models\UserInfo;
use Exception;
use Illuminate\Http\Request;
use View;

class StudentDeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $studentDevices = StudentDevice::with('userInfo', 'academicYear', 'studentDeviceInventory')->get();
        
        return view('pages.student_devices.student_devices.index', compact('studentDevices'));
    }

    public function create(){
        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $studentDeviceTypes = StudentDeviceType::where('active', 1)->pluck('device_type', 'id')->all();

        return view('pages.student_devices.student_devices.create', compact('academicYears', 'studentDeviceTypes'));
    }

    /**
     * Store a new campus in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);
            
            $studentDeviceInventories = StudentDeviceInventory::whereIn('device_imei', $data['device_imei'])
                                                            ->get();

            
            foreach ($data['device_imei'] as $key => $device) {
                
                $studentDeviceInventory = $studentDeviceInventories->where('device_imei', $device)
                                                                ->where('status', 'Available')
                                                                ->first();
                
                if(!$studentDeviceInventory){
                    return back()->withInput()
                        ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request. Device not found']);
                }
                    
                StudentDevice::create([
                    'user_info_id' => $data['user_info_id'],
                    'academic_year_id' => $data['academic_year_id'],
                    'student_device_inventory_id' => $studentDeviceInventory->id,
                    'issue_date' => $data['issue_date'],
                    'valid_until' => $request->valid_until[$key],
                    'captured_by' => $data['captured_by']
                ]);
                
            }

            return redirect()->route('student_devices.index')
            ->with('success_message', 'Student device was successfully added.');
        } catch (Exception $exception) {
            dd($exception);
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function simReplacement($id)
    {

        $studentDevice = StudentDevice::with('userInfo', 'academicYear')->find($id);

        return view('pages.portal.student_devices.print', compact('studentDevice'));
    }

    public function getStudentInfo($studentNumber){

        $currentAcademicYear = AcademicYear::where('name', date('Y'))->first();

        $userInfo = UserInfo::where('student_number', $studentNumber)->first();

        if(!$userInfo){
            return response()->json([
                'status' => 0,
                'message' => 'Student information not found.'
            ]);
        }

        $registration = Registration::with('qualification', 'studyMode', 'academicIntake', 'campus')
                                    ->where('user_info_id', $userInfo->id)
                                    ->where('academic_year_id', $currentAcademicYear->id)
                                    ->where('registration_status_id', 1)
                                    ->first();

        if (!$registration) {
            return response()->json([
                'status' => 0,
                'message' => 'This student is not registered for the current academic year.'
            ]);
        }

        return response()->json([
            'status' => 1,
            'userInfo' => $userInfo,
            'registration' => $registration
        ]);
    }

    public function addDeviceRow()
    {
        $studentDeviceInventories = StudentDeviceInventory::where('status', 'Available')->pluck('device_imei', 'id')->all();

        $html = View::make('pages.student_devices.student_devices.add-device', compact('studentDeviceInventories'))->render();

        return response()->json(['html' => $html]);
    }

    public function deleteDevice($allocationId){
        $studentDevice = StudentDevice::destroy($allocationId);

        return response()->json([
            'message' => 'Device successfully removed from student'
        ]);


    }

    public function getDeviceInfo($device_imei){

        $studentDeviceInventory = StudentDeviceInventory::with('studentDeviceType')
                                                        ->where('device_imei', $device_imei)
                                                        ->first();

        return response()->json([
            'studentDeviceInventory' => $studentDeviceInventory
        ]);

    }

    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
            'user_info_id' => 'required',
            'academic_year_id' => 'required',
            'captured_by' => 'required',
            'issue_date' => 'required',
            'device_imei' => 'required',       
        ];

        $data = $request->validate($rules);


        return $data;
    }
}
