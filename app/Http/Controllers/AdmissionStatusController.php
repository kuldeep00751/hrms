<?php

namespace App\Http\Controllers;

use App\Models\AdmissionStatus;
use Exception;
use Illuminate\Http\Request;

class AdmissionStatusController extends Controller
{
    /**
     * Display a listing of the education systems.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {

        $admissionStatuses = AdmissionStatus::paginate(25);

        return view('pages.settings.admission_statuses.index', compact('admissionStatuses'));
    }

    /**
     * Show the form for creating a new education system.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $full_admission_options = [
            0 => "No",
            1 => "Yes"
        ];

        return view('pages.settings.admission_statuses.create', compact('full_admission_options'));
    }

    /**
     * Store a new education system in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);
            
            AdmissionStatus::create($data);
            
            return redirect()->route('admission_statuses.admission_status.index')
                ->with('success_message', 'Admission Status was successfully added.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified education system.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $educationSystem = AdmissionStatus::findOrFail($id);

        return view('pages.settings.admission_statuses.show', compact('educationSystem'));
    }

    /**
     * Show the form for editing the specified education system.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $admissionStatus = AdmissionStatus::findOrFail($id);

        $full_admission_options = [
            0 => "No",
            1 => "Yes"
        ];

        return view('pages.settings.admission_statuses.edit', compact('admissionStatus', 'full_admission_options'));
    }

    /**
     * Update the specified education system in the storage.
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

            $admissionStatus = AdmissionStatus::findOrFail($id);

            $admissionStatus->update($data);

            return redirect()->route('admission_statuses.admission_status.index')
                ->with('success_message', 'Admission Status was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified education system from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $admissionStatus = AdmissionStatus::findOrFail($id);
            $admissionStatus->delete();

            return redirect()->route('admission_statuses.education_system.index')
                ->with('success_message', 'Admission Status was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function updateStatus(Request $request)
    {

        $admissionStatus = AdmissionStatus::find($request->id);

        $admissionStatus->active = $request->active;

        $admissionStatus->save();

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
            'order' => 'numeric|min:1|required',
            'status' => 'string|min:1|required',
            'description' => 'string|min:1|required',
            'full_admission' => 'numeric|required',
        ];

        $data = $request->validate($rules);


        return $data;
    }
}
