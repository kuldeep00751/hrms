<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\ModuleStudyMode;
use App\Models\StudyMode;
use Illuminate\Http\Request;
use Exception;

class ModuleStudyModesController extends Controller
{

    /**
     * Display a listing of the module study modes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $moduleStudyModes = ModuleStudyMode::with('studymode','module')->paginate(25);

        return view('module_study_modes.index', compact('moduleStudyModes'));
    }

    /**
     * Show the form for creating a new module study mode.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $studyModes = StudyMode::pluck('study_mode','id')->all();
$modules = Module::pluck('module_code','id')->all();
        
        return view('module_study_modes.create', compact('studyModes','modules'));
    }

    /**
     * Store a new module study mode in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            ModuleStudyMode::create($data);

            return redirect()->route('module_study_modes.module_study_mode.index')
                ->with('success_message', 'Module Study Mode was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified module study mode.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $moduleStudyMode = ModuleStudyMode::with('studymode','module')->findOrFail($id);

        return view('module_study_modes.show', compact('moduleStudyMode'));
    }

    /**
     * Show the form for editing the specified module study mode.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $moduleStudyMode = ModuleStudyMode::findOrFail($id);
        $studyModes = StudyMode::pluck('study_mode','id')->all();
$modules = Module::pluck('module_code','id')->all();

        return view('module_study_modes.edit', compact('moduleStudyMode','studyModes','modules'));
    }

    /**
     * Update the specified module study mode in the storage.
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
            
            $moduleStudyMode = ModuleStudyMode::findOrFail($id);
            $moduleStudyMode->update($data);

            return redirect()->route('module_study_modes.module_study_mode.index')
                ->with('success_message', 'Module Study Mode was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified module study mode from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $moduleStudyMode = ModuleStudyMode::findOrFail($id);
            $moduleStudyMode->delete();

            return redirect()->route('module_study_modes.module_study_mode.index')
                ->with('success_message', 'Module Study Mode was successfully deleted.');
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
                'study_mode_id' => 'nullable',
            'module_id' => 'nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
