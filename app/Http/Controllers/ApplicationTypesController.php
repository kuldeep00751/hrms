<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ApplicationType;
use Illuminate\Http\Request;
use Exception;

class ApplicationTypesController extends Controller
{

    /**
     * Display a listing of the application types.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $applicationTypes = ApplicationType::paginate(25);

        return view('pages.settings.application_types.index', compact('applicationTypes'));
    }

    /**
     * Show the form for creating a new application type.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('pages.settings.application_types.create');
    }

    /**
     * Store a new application type in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            ApplicationType::create($data);

            return redirect()->route('application_types.application_type.index')
                ->with('success_message', 'Application Type was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified application type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $applicationType = ApplicationType::findOrFail($id);

        return view('pages.settings.application_types.show', compact('applicationType'));
    }

    /**
     * Show the form for editing the specified application type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $applicationType = ApplicationType::findOrFail($id);
        

        return view('pages.settings.application_types.edit', compact('applicationType'));
    }

    /**
     * Update the specified application type in the storage.
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
            
            $applicationType = ApplicationType::findOrFail($id);
            $applicationType->update($data);

            return redirect()->route('application_types.application_type.index')
                ->with('success_message', 'Application Type was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified application type from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $applicationType = ApplicationType::findOrFail($id);
            $applicationType->delete();

            return redirect()->route('application_types.application_type.index')
                ->with('success_message', 'Application Type was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function updateStatus(Request $request)
    {

        $applicationType = ApplicationType::find($request->id);

        $applicationType->active = $request->active;

        $applicationType->save();

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
                'application_type' => 'string|min:1|required', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
