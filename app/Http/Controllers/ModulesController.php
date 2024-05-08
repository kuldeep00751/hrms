<?php

namespace App\Http\Controllers;

use App\Actions\CreateCurriculum;
use App\Actions\CreateModuleStudyMode;
use App\Actions\CreateModuleStudyPeriod;
use App\Http\Controllers\Controller;
use App\Models\ApplicationType;
use App\Models\ExamPaper;
use App\Models\Module;
use App\Models\NqfLevel;
use App\Models\Qualification;
use App\Models\StudyMode;
use App\Models\StudyPeriod;
use App\Models\YearLevel;
use Illuminate\Http\Request;
use Exception;

class ModulesController extends Controller
{

    /**
     * Display a listing of the modules.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
    
        $modules = Module::with('studyPeriods','studyModes','moduleLevel','nqfLevel')->get();

        return view('pages.settings.modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new module.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $moduleLevels = ApplicationType::pluck('application_type', 'id')->all();

        $nqfLevels = NqfLevel::pluck('nqf_level', 'id')->all();

        $studyPeriods = StudyPeriod::pluck('study_period', 'id')->all();

        $yearLevels = YearLevel::pluck('year_level', 'id')->all();

        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();
        
        return view('pages.settings.modules.create', compact('studyModes', 'moduleLevels', 'nqfLevels', 'studyPeriods', 'qualifications', 'yearLevels'));
    }

    /**
     * Store a new module in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request, CreateModuleStudyPeriod $moduleStudyPeriod, CreateModuleStudyMode $moduleStudyMode, CreateCurriculum $curriculum)
    {
        $data = $this->getData($request);
        try {
              
            $module = Module::create($data);

            $moduleStudyPeriod->create($data, $module->id);

            $moduleStudyMode->create($data, $module->id);

            $curriculum->create($data, $module->id);

            return redirect()->route('modules.module.index')
                ->with('success_message', 'Module was successfully added.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified module.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $module = Module::with('studyPeriods', 'studyModes', 'moduleLevel', 'nqfLevel')->findOrFail($id);

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $moduleLevels = ApplicationType::pluck('application_type', 'id')->all();

        $nqfLevels = NqfLevel::pluck('nqf_level', 'id')->all();

        $studyPeriods = StudyPeriod::pluck('study_period', 'id')->all();

        return view('pages.settings.modules.show', compact('module','studyModes', 'moduleLevels', 'nqfLevels', 'studyPeriods'));
    }

    /**
     * Show the form for editing the specified module.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $module = Module::findOrFail($id);

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $moduleLevels = ApplicationType::pluck('application_type', 'id')->all();

        $nqfLevels = NqfLevel::pluck('nqf_level', 'id')->all();

        $studyPeriods = StudyPeriod::pluck('study_period', 'id')->all();

        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();

        $yearLevels = YearLevel::pluck('year_level', 'id')->all();

        return view('pages.settings.modules.edit', compact('module','studyModes', 'moduleLevels', 'nqfLevels', 'studyPeriods', 'qualifications', 'yearLevels'));
    }

    /**
     * Update the specified module in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request,CreateModuleStudyPeriod $moduleStudyPeriod, CreateModuleStudyMode $moduleStudyMode, CreateCurriculum $curriculum)
    {
        $data = $this->validate($request, [
            'module_code' => 'string|min:1|required|unique:modules,module_code,'. $id,
            'module_name' => 'string|min:1|required',
            'module_credits' => 'required',
            'module_level_id' => 'required',
            'study_mode_id' => 'required',
            'study_period_id' => 'required',
            'nqf_level_id' => 'required',
            'year_level_id' => 'required',
            'qualification_id' => 'required',
            'lecture_duration' => 'required',

        ]);
        try {
            
            $module = Module::findOrFail($id);

            $module->update($data);

            $moduleStudyPeriod->update($data, $module);

            $moduleStudyMode->update($data, $module);

            $curriculum->update($data, $module);

            return redirect()->route('modules.module.index')
                ->with('success_message', 'Module was successfully updated.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified module from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $module = Module::findOrFail($id);
            $module->delete();

            return redirect()->route('modules.module.index')
                ->with('success_message', 'Module was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
        
    }

    public function updateStatus(Request $request)
    {

        $module = Module::find($request->id);

        $module->active = $request->active;

        $module->save();

        return response()->json(array('success_message' => 'Status was successfully added.'), 200);
    }

    public function getModulesViaAjax(){
        $modules = Module::with('studyPeriods', 'studyModes')->get();

        return view('pages.settings.academic_structures.modules', compact('modules'))->render();
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
            'module_code' => 'string|min:1|required|unique:modules',
            'module_name' => 'string|min:1|required',
            'module_credits' => 'required',
            'module_level_id' => 'required',
            'study_mode_id' => 'required',
            'study_period_id' => 'required',
            'nqf_level_id' => 'required',
            'year_level_id' => 'required',
            'qualification_id' => 'required',
            'lecture_duration' => 'required',
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
