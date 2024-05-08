<?php

namespace App\Http\Controllers;

use App\Exports\ClassAttendance;
use App\Exports\ClassAttendanceRegisterLog;
use App\Models\AttendanceRegister;
use App\Models\AttendanceRegisterStudent;
use App\Models\ModuleAllocation;
use App\Models\ModuleRegistration;
use Excel;
use Exception;
use Illuminate\Http\Request;

class AttendanceRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($moduleAllocation){

        $moduleAllocation = ModuleAllocation::with('module')->find($moduleAllocation);

        $attendanceRegisters = AttendanceRegister::with('userInfo', 'recordedBy')
                                                    ->where('academic_year_id', $moduleAllocation->academic_year_id)
                                                    ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
                                                    ->where('campus_id', $moduleAllocation->campus_id)
                                                    ->where('module_id', $moduleAllocation->module_id)
                                                    ->where('study_mode_id', $moduleAllocation->study_mode_id)
                                                    ->get();
        
        $moduleRegistrationCount = ModuleRegistration::where('academic_year_id', $moduleAllocation->academic_year_id)
                                                ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
                                                ->where('campus_id', $moduleAllocation->campus_id)
                                                ->where('study_mode_id', $moduleAllocation->study_mode_id)
                                                ->where('module_id', $moduleAllocation->module_id)
                                                ->where('is_cancelled', 0)
                                                ->where('is_exempted', 0)
                                                ->count();

        return view('pages.assessments.my_modules.attendance_register.index', compact('moduleAllocation', 'attendanceRegisters', 'moduleRegistrationCount'));
    }

    public function create($moduleAllocation){

        $moduleAllocation = ModuleAllocation::with('module','academicIntake', 'academicYear', 'studyMode', 'campus')->find($moduleAllocation);

        $moduleRegistrations = ModuleRegistration::with('module', 'academicIntake', 'academicYear', 'studyMode', 'campus')
                                                    ->where('academic_year_id', $moduleAllocation->academic_year_id)
                                                    ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
                                                    ->where('campus_id', $moduleAllocation->campus_id)
                                                    ->where('study_mode_id', $moduleAllocation->study_mode_id)
                                                    ->where('module_id', $moduleAllocation->module_id)
                                                    ->where('is_cancelled', 0)
                                                    ->where('is_exempted', 0)
                                                    ->join('user_infos', 'user_infos.id', '=', 'module_registrations.user_info_id')
                                                    ->orderBy('user_infos.surname')
                                                    ->get();

        return view('pages.assessments.my_modules.attendance_register.create', compact('moduleAllocation', 'moduleRegistrations'));
    }

    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);

            $data['recorded_by'] = auth()->user()->id;

            $attendanceRegister = AttendanceRegister::create($data);
            
            foreach($request->user_info_id as $key => $user_info_id){
                
                AttendanceRegisterStudent::create(
                    [
                        'attendance_register_id' => $attendanceRegister->id, 
                        'user_info_id' => $user_info_id, 
                        'student_number' => $request->student_number[$key],
                        'first_names' => $request->first_names[$key],
                        'surname' => $request->surname[$key],
                        'attendance_duration' => $request->attendance_duration[$key]
                    ]
                );
            }

            return redirect()->route('assessments.attendance_register.index', $request->module_allocation_id)
            ->with('success_message', 'Attendance Register successfully added.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function edit($id){
        $attendanceRegister = AttendanceRegister::with('userInfo', 'studyMode', 'campus', 'module', 'academicYear', 'academicIntake')->find($id);

        $moduleAllocation = ModuleAllocation::where('academic_year_id', $attendanceRegister->academic_year_id)
                                            ->where('academic_intake_id', $attendanceRegister->academic_intake_id)
                                            ->where('campus_id', $attendanceRegister->campus_id)
                                            ->where('study_mode_id', $attendanceRegister->study_mode_id)
                                            ->where('module_id', $attendanceRegister->module_id)
                                            ->where('user_id', auth()->user()->id)
                                            ->first();

        $moduleRegistrations = ModuleRegistration::where('academic_year_id', $moduleAllocation->academic_year_id)
                                                    ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
                                                    ->where('campus_id', $moduleAllocation->campus_id)
                                                    ->where('study_mode_id', $moduleAllocation->study_mode_id)
                                                    ->where('module_id', $moduleAllocation->module_id)
                                                    ->where('is_cancelled', 0)
                                                    ->where('is_exempted', 0)
                                                    ->get();

        return view('pages.assessments.my_modules.attendance_register.edit', compact('attendanceRegister', 'moduleAllocation', 'moduleRegistrations'));
    }

    public function update(Request $request, $id){
        try {

            $data = $this->getData($request);

            $data['recorded_by'] = auth()->user()->id;

            $attendanceRegister = AttendanceRegister::find($id);

            $attendanceRegister->update($data);

            $attendanceRegister->userInfo()->delete();
            
            foreach ($request->user_info_id as $key => $user_info_id) {
                
                AttendanceRegisterStudent::create(
                    [
                        'attendance_register_id' => $attendanceRegister->id,
                        'user_info_id' => $user_info_id,
                        'student_number' => $request->student_number[$user_info_id],
                        'first_names' => $request->first_names[$user_info_id],
                        'surname' => $request->surname[$user_info_id],
                        'attendance_duration' => $request->attendance_duration[$user_info_id]
                    ]
                );
            }

            return redirect()->route('assessments.attendance_register.index', $request->module_allocation_id)
                ->with('success_message', 'Attendance Register successfully updated.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function show($id)
    {
        $attendanceRegister = AttendanceRegister::with('userInfo', 'studyMode', 'campus', 'module', 'academicYear', 'academicIntake')->find($id);

        $moduleAllocation = ModuleAllocation::where('academic_year_id', $attendanceRegister->academic_year_id)
            ->where('academic_intake_id', $attendanceRegister->academic_intake_id)
            ->where('campus_id', $attendanceRegister->campus_id)
            ->where('study_mode_id', $attendanceRegister->study_mode_id)
            ->where('module_id', $attendanceRegister->module_id)
            ->where('user_id', auth()->user()->id)
            ->first();

        $moduleRegistrations = ModuleRegistration::where('academic_year_id', $moduleAllocation->academic_year_id)
            ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
            ->where('campus_id', $moduleAllocation->campus_id)
            ->where('study_mode_id', $moduleAllocation->study_mode_id)
            ->where('module_id', $moduleAllocation->module_id)
            ->where('is_cancelled', 0)
            ->where('is_exempted', 0)
            ->get();

        return view('pages.assessments.my_modules.attendance_register.show', compact('attendanceRegister', 'moduleAllocation', 'moduleRegistrations'));
    }

    public function downloadSingleRegister($id){
        $attendanceRegister = AttendanceRegister::with('userInfo', 'studyMode', 'campus', 'module', 'academicYear', 'academicIntake')->find($id);
        session()->put('attendanceRegister', $attendanceRegister);

        $moduleAllocation = ModuleAllocation::where('academic_year_id', $attendanceRegister->academic_year_id)
            ->where('academic_intake_id', $attendanceRegister->academic_intake_id)
            ->where('campus_id', $attendanceRegister->campus_id)
            ->where('study_mode_id', $attendanceRegister->study_mode_id)
            ->where('module_id', $attendanceRegister->module_id)
            ->where('user_id', auth()->user()->id)
            ->first();

        session()->put('moduleAllocation', $moduleAllocation);

        $moduleRegistrations = ModuleRegistration::where('academic_year_id', $moduleAllocation->academic_year_id)
            ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
            ->where('campus_id', $moduleAllocation->campus_id)
            ->where('study_mode_id', $moduleAllocation->study_mode_id)
            ->where('module_id', $moduleAllocation->module_id)
            ->where('is_cancelled', 0)
            ->where('is_exempted', 0)
            ->get();

        session()->put('moduleRegistrations', $moduleRegistrations);

        $filename = $attendanceRegister->module->module_name . "_" . $attendanceRegister->attendance_date ."_attendance_register_";

        return Excel::download(new ClassAttendance, $filename . '' . '.xlsx');

    }

    public function downloadModuleRegister($moduleAllocation){
        $moduleAllocation = ModuleAllocation::with('module')->find($moduleAllocation);
        session()->put('moduleAllocation', $moduleAllocation);

        $attendanceRegisters = AttendanceRegister::with('userInfo', 'recordedBy')
                                                ->where('academic_year_id', $moduleAllocation->academic_year_id)
                                                ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
                                                ->where('campus_id', $moduleAllocation->campus_id)
                                                ->where('module_id', $moduleAllocation->module_id)
                                                ->where('study_mode_id', $moduleAllocation->study_mode_id)
                                                ->orderBy('attendance_date')
                                                ->get();

        session()->put('attendanceRegisters', $attendanceRegisters);

        $moduleRegistrations = ModuleRegistration::where('academic_year_id', $moduleAllocation->academic_year_id)
                                                ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
                                                ->where('campus_id', $moduleAllocation->campus_id)
                                                ->where('study_mode_id', $moduleAllocation->study_mode_id)
                                                ->where('module_id', $moduleAllocation->module_id)
                                                ->where('is_cancelled', 0)
                                                ->where('is_exempted', 0)
                                                ->get();

        session()->put('moduleRegistrations', $moduleRegistrations);

        $filename = $moduleAllocation->module->module_name . "_" . $moduleAllocation->academicYear->name . "_attendance_register_";

        return Excel::download(new ClassAttendanceRegisterLog, $filename . '' . '.xlsx');
    }

    public function destroy($id)
    {
        AttendanceRegisterStudent::where('attendance_register_id', $id)->delete();

        AttendanceRegister::find($id)->delete();

        return redirect()->back()
            ->with('success_message', 'Attendance Register successfully deleted.');
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
            'academic_year_id' => 'required',
            'study_mode_id' => 'required',
            'academic_intake_id' => 'required',
            'campus_id' => 'required',
            'module_id' => 'required',
            'attendance_date' => 'required|date',
            'user_info_id' => 'required',
            'attendance_duration' => 'required',
            'student_number' => 'required',
            'first_names' => 'required',
            'surname' => 'required'
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
