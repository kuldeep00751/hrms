<?php

namespace App\Http\Controllers;

use App\Models\RegistrationStatus;
use Exception;
use Illuminate\Http\Request;

class RegistrationStatusController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the education systems.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {

        $registrationStatuses = RegistrationStatus::paginate(25);

        return view('pages.settings.registration_statuses.index', compact('registrationStatuses'));
    }

    /**
     * Show the form for creating a new education system.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
    
        return view('pages.settings.registration_statuses.create');
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

            RegistrationStatus::create($data);

            return redirect()->route('registration_statuses.registration_status.index')
                ->with('success_message', 'Registration Status was successfully added.');
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
        $registrationStatus = RegistrationStatus::findOrFail($id);

        return view('pages.settings.registration_statuses.show', compact('registrationStatus'));
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
        $registrationStatus = RegistrationStatus::findOrFail($id);

        return view('pages.settings.registration_statuses.edit', compact('registrationStatus'));
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

            $registrationStatus = RegistrationStatus::findOrFail($id);

            $registrationStatus->update($data);

            return redirect()->route('registration_statuses.registration_status.index')
                ->with('success_message', 'Registration Status was successfully updated.');
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
            $registrationStatus = RegistrationStatus::findOrFail($id);
            $registrationStatus->delete();

            return redirect()->route('registration_statuses.education_system.index')
                ->with('success_message', 'Registration Status was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
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
            'status' => 'string|min:1|required',
            'description' => 'string|min:1|required',
        ];

        $data = $request->validate($rules);


        return $data;
    }
}
