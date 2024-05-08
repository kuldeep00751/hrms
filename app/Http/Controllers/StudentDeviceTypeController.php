<?php

namespace App\Http\Controllers;

use App\Models\StudentDeviceType;
use Exception;
use Illuminate\Http\Request;

class StudentDeviceTypeController extends Controller
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
        $studentDeviceTypes = StudentDeviceType::all();

        return view('pages.settings.student_device_types.index', compact('studentDeviceTypes'));
    }

    /**
     * Show the form for creating a new qualification.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $replaceableOptions = [
            1 => 'Yes',
            0 => 'No',
        ];

        $validMonthsOptions = [
            '12' => '12 Months',
            '24' => '24 Months',
            '36' => '36 Months',
            '0' => 'Indefinite',
        ];
        
        return view('pages.settings.student_device_types.create', compact('replaceableOptions', 'validMonthsOptions'));
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

            StudentDeviceType::create($data);


            return redirect()->route('student_device_types.student_device_type.index')
            ->with('success_message', 'Student Device Type was successfully added.');
        } catch (Exception $exception) {
            dd($exception);
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
        $studentDeviceType = StudentDeviceType::findOrFail($id);

        $replaceableOptions = [
            1 => 'Yes',
            0 => 'No',
        ];

        $validMonthsOptions = [
            '12' => '12 Months',
            '24' => '24 Months',
            '36' => '36 Months',
            '0' => 'Indefinite',
        ];
        
        return view('pages.settings.student_device_types.edit', compact('studentDeviceType', 'replaceableOptions', 'validMonthsOptions'));
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

            $studentDeviceType = StudentDeviceType::findOrFail($id);

            $studentDeviceType->update($data);

         

            return redirect()->route('student_device_types.student_device_type.index')
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
            'device_type' => 'string|min:1|required',
            'replaceable' => 'integer|required',
            'valid_months' => 'integer|required',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
