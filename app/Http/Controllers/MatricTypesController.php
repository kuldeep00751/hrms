<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EducationSystem;
use App\Models\MatricType;
use Illuminate\Http\Request;
use Exception;

class MatricTypesController extends Controller
{

    /**
     * Display a listing of the matric types.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $matricTypes = MatricType::with('educationSystem')->paginate(25);
    
        return view('pages.settings.matric_types.index', compact('matricTypes'));
    }

    /**
     * Show the form for creating a new matric type.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $educationSystems = EducationSystem::pluck('system_name', 'id')->all();

        return view('pages.settings.matric_types.create', compact('educationSystems'));
    }

    /**
     * Store a new matric type in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            MatricType::create($data);

            return redirect()->route('matric_types.matric_type.index')
                ->with('success_message', 'Matric Type was successfully added.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified matric type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $matricType = MatricType::findOrFail($id);

        $educationSystems = EducationSystem::pluck('system_name', 'id')->all();

        return view('pages.settings.matric_types.show', compact('matricType', 'educationSystems'));
    }

    /**
     * Show the form for editing the specified matric type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $matricType = MatricType::findOrFail($id);

        $educationSystems = EducationSystem::pluck('system_name', 'id')->all();

        return view('pages.settings.matric_types.edit', compact('matricType', 'educationSystems'));
    }

    /**
     * Update the specified matric type in the storage.
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
            
            $matricType = MatricType::findOrFail($id);
            $matricType->update($data);

            return redirect()->route('matric_types.matric_type.index')
                ->with('success_message', 'Matric Type was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified matric type from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $matricType = MatricType::findOrFail($id);
            $matricType->delete();

            return redirect()->route('matric_types.matric_type.index')
                ->with('success_message', 'Matric Type was successfully deleted.');
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
                'matric_type' => 'string|min:1|required', 
                'education_system_id' => 'required', 
                'grade' => 'string|min:1|required', 
                'points' => 'numeric|required', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
