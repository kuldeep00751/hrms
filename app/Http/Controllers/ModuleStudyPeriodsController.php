<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\ModuleStudyPeriod;
use App\Models\StudyPeriod;
use Illuminate\Http\Request;
use Exception;

class ModuleStudyPeriodsController extends Controller
{

    /**
     * Display a listing of the module study periods.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $moduleStudyPeriods = ModuleStudyPeriod::with('studyperiod','module')->paginate(25);

        return view('module_study_periods.index', compact('moduleStudyPeriods'));
    }

    /**
     * Show the form for creating a new module study period.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $studyPeriods = StudyPeriod::pluck('study_period','id')->all();
$modules = Module::pluck('module_code','id')->all();
        
        return view('module_study_periods.create', compact('studyPeriods','modules'));
    }

    /**
     * Store a new module study period in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            ModuleStudyPeriod::create($data);

            return redirect()->route('module_study_periods.module_study_period.index')
                ->with('success_message', 'Module Study Period was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified module study period.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $moduleStudyPeriod = ModuleStudyPeriod::with('studyperiod','module')->findOrFail($id);

        return view('module_study_periods.show', compact('moduleStudyPeriod'));
    }

    /**
     * Show the form for editing the specified module study period.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $moduleStudyPeriod = ModuleStudyPeriod::findOrFail($id);
        $studyPeriods = StudyPeriod::pluck('study_period','id')->all();
$modules = Module::pluck('module_code','id')->all();

        return view('module_study_periods.edit', compact('moduleStudyPeriod','studyPeriods','modules'));
    }

    /**
     * Update the specified module study period in the storage.
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
            
            $moduleStudyPeriod = ModuleStudyPeriod::findOrFail($id);
            $moduleStudyPeriod->update($data);

            return redirect()->route('module_study_periods.module_study_period.index')
                ->with('success_message', 'Module Study Period was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified module study period from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $moduleStudyPeriod = ModuleStudyPeriod::findOrFail($id);
            $moduleStudyPeriod->delete();

            return redirect()->route('module_study_periods.module_study_period.index')
                ->with('success_message', 'Module Study Period was successfully deleted.');
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
                'study_period_id' => 'nullable',
            'module_id' => 'nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
