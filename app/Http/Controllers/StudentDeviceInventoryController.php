<?php

namespace App\Http\Controllers;

use App\Models\StudentDeviceInventory;
use App\Models\StudentDeviceType;
use Exception;
use Illuminate\Http\Request;

class StudentDeviceInventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the qualifications.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $studentDeviceInventories = StudentDeviceInventory::all();

        return view('pages.student_devices.inventory.index', compact('studentDeviceInventories'));
    }

    /**
     * Show the form for creating a new qualification.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $studentDeviceTypes = StudentDeviceType::where('active', 1)->pluck('device_type', 'id');

        $deviceStatusOptions = [
            'Available' => 'Available',
        ];

        return view('pages.student_devices.inventory.create', compact('studentDeviceTypes', 'deviceStatusOptions'));
    }

    /**
     * Store a new qualification in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            StudentDeviceInventory::create($data);

            return redirect()->route('student_device_inventories.student_device_inventory.index')
            ->with('success_message', 'Device was successfully added.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified qualification.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $studentDeviceTypes = StudentDeviceType::where('active', 1)->pluck('device_type', 'id');

        $deviceStatusOptions = [
            'Available' => 'Available',
            'Disposed' => 'Disposed',
            'Allocated' => 'Allocated',
        ];

        $studentDeviceInventory = StudentDeviceInventory::findOrFail($id);

        return view('pages.student_devices.inventory.edit', compact('studentDeviceTypes', 'studentDeviceInventory', 'deviceStatusOptions'));
    }

    /**
     * Update the specified qualification in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {

            $data = $this->getData($request);

            $studentDeviceInventory = StudentDeviceInventory::findOrFail($id);

            $studentDeviceInventory->update($data);

            return redirect()->route('student_device_inventories.student_device_inventory.index')
            ->with('success_message', 'Student device type was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    public function updateStatus(Request $request)
    {

        $studentDeviceType = StudentDeviceType::find($request->id);

        $studentDeviceType->active = $request->active;

        $studentDeviceType->save();

        return response()->json(array('success_message' => 'Status was successfully added.'), 200);
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
            'device_imei' => 'string|required',
            'student_device_type_id' => 'integer|required',
            'description' => 'string|required',
            'remarks' => 'nullable',
            'status' => 'string|required',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
