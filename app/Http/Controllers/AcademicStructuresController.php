<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AcademicStructure;
use App\Models\AcademicYear;
use App\Models\Module;
use App\Models\Qualification;
use App\Models\StudyPeriod;
use App\Models\YearLevel;
use Illuminate\Http\Request;
use Exception;

class AcademicStructuresController extends Controller
{

    /**
     * Display a listing of the academic structures.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $qualifications = Qualification::with('studyModes', 'qualificationType', 'numberOfYears', 'nqfLevel')->paginate(25);

        return view('pages.settings.academic_structures.index', compact('qualifications'));
    }

    /**
     * Show the form for creating a new academic structure.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $academicYears = AcademicYear::pluck('name','id')->all();
        $qualifications = Qualification::pluck('qualification_name','id')->all();
        $yearLevels = YearLevel::pluck('year_level','id')->all();
        $studyPeriods = StudyPeriod::pluck('study_period','id')->all();
        $modules = Module::pluck('module_name','id')->all();
        
        return view('pages.settings.academic_structures.create', compact('academicYears','qualifications','yearLevels','studyPeriods','modules'));
    }

    /**
     * Store a new academic structure in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            AcademicStructure::create($data);

            return redirect()->route('academic_structures.academic_structure.index')
                ->with('success_message', 'Academic Structure was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified academic structure.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $academicStructure = AcademicStructure::with('academicyear','qualification','yearlevel','studyperiod','module')->findOrFail($id);

        return view('academic_structures.show', compact('academicStructure'));
    }

    /**
     * Show the form for editing the specified academic structure.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $qualification = Qualification::findOrFail($id);
        $academicStructure = $qualification->academicStructure;
        $academicYears = AcademicYear::pluck('name','id')->all();
        $yearLevels = YearLevel::pluck('year_level','id')->all();
        $studyPeriods = StudyPeriod::pluck('study_period','id')->all();
        $modules = Module::pluck('module_code','id')->all();

        return view('pages.settings.academic_structures.edit', compact('qualification','academicStructure','academicYears','yearLevels','studyPeriods','modules'));
    }

    /**
     * Update the specified academic structure in the storage.
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
            
            $academicStructure = AcademicStructure::findOrFail($id);
            $academicStructure->update($data);

            return redirect()->route('academic_structures.academic_structure.index')
                ->with('success_message', 'Academic Structure was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified academic structure from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $academicStructure = AcademicStructure::findOrFail($id);
            $academicStructure->delete();

            return redirect()->route('academic_structures.academic_structure.index')
                ->with('success_message', 'Academic Structure was successfully deleted.');
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
                'academic_year_id' => 'nullable',
            'qualification_id' => 'nullable',
            'year_level_id' => 'nullable',
            'study_period_id' => 'nullable',
            'module_id' => 'nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
