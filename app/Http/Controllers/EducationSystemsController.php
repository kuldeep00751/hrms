<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EducationSystem;
use Illuminate\Http\Request;
use Exception;

class EducationSystemsController extends Controller
{

    /**
     * Display a listing of the education systems.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $educationSystems = EducationSystem::paginate(25);

        return view('pages.settings.education_systems.index', compact('educationSystems'));
    }

    /**
     * Show the form for creating a new education system.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('pages.settings.education_systems.create');
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
            
            EducationSystem::create($data);

            return redirect()->route('education_systems.education_system.index')
                ->with('success_message', 'Education System was successfully added.');
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
        $educationSystem = EducationSystem::findOrFail($id);

        return view('pages.settings.education_systems.show', compact('educationSystem'));
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
        $educationSystem = EducationSystem::findOrFail($id);
        

        return view('pages.settings.education_systems.edit', compact('educationSystem'));
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
            
            $educationSystem = EducationSystem::findOrFail($id);
            $educationSystem->update($data);

            return redirect()->route('education_systems.education_system.index')
                ->with('success_message', 'Education System was successfully updated.');
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
            $educationSystem = EducationSystem::findOrFail($id);
            $educationSystem->delete();

            return redirect()->route('education_systems.education_system.index')
                ->with('success_message', 'Education System was successfully deleted.');
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
                'system_name' => 'string|min:1|required', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
