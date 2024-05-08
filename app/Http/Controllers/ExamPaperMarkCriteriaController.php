<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\AssessmentResultCode;
use App\Models\AssessmentType;
use App\Models\ExamPaper;
use App\Models\ExamPaperMarkCriteria;
use App\Models\Module;
use Exception;
use Illuminate\Http\Request;

class ExamPaperMarkCriteriaController extends Controller
{

    public function __construct(){
        
        return $this->middleware('auth');

    }
    /**
     * Display a listing of the study modes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $examPaperMarkCriterias = ExamPaperMarkCriteria::with('module','academicYear','assessmentType','examPaper','assessmentResultCode')->paginate(25);
        
        return view('pages.settings.exam_paper_mark_criterias.index', compact('examPaperMarkCriterias'));
    }

    /**
     * Show the form for creating a new study mode.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {

        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        $assessmentTypes = AssessmentType::where('active',1)->pluck('assessment_type', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $assessmentResultCode = AssessmentResultCode::selectRaw('concat(result_code, concat("-",result_code_description)) as result_code, id')->pluck('result_code', 'id')->all();

        return view('pages.settings.exam_paper_mark_criterias.create', compact('modules', 'assessmentTypes', 'academicYears', 'assessmentResultCode'));
    }

    /**
     * Store a new study mode in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);
            
            ExamPaperMarkCriteria::where('module_id', $data['module_id'])
                                    ->where('academic_year_id', $data['academic_year_id'])
                                    ->where('assessment_type_id', $data['academic_year_id'])
                                    ->delete();
            
            foreach($data['exam_paper_id'] as $key => $exam_paper_id){
                ExamPaperMarkCriteria::create(
                    [
                        'module_id' => $data['module_id'],
                        'academic_year_id' => $data['academic_year_id'],
                        'assessment_type_id' => $data['assessment_type_id'],
                        'exam_paper_id' => $exam_paper_id,
                        'assessment_result_code_id' => $data['assessment_result_code_id'][$key],
                        'range_from' => $data['range_from'][$key],
                        'range_to' => $data['range_to'][$key],
                        'created_by' => auth()->user()->id
                    ]
                );
            }


            return redirect()->route('exam_paper_mark_criterias.exam_paper_mark_criteria.index')
            ->with('success_message', 'Grading Scale was successfully added.');
        } catch (Exception $exception) {
            dd($exception);
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified study mode.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $assessmentType = AssessmentType::findOrFail($id);

        return view('pages.settings.exam_paper_mark_criterias.show', compact('assessmentType'));
    }

    /**
     * Show the form for editing the specified study mode.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $examPaperMarkCriteria = ExamPaperMarkCriteria::findOrFail($id);

        $examPaperMarkCriterias = ExamPaperMarkCriteria::where('module_id', $examPaperMarkCriteria->module_id)
                                                        ->where('academic_year_id', $examPaperMarkCriteria->academic_year_id)
                                                        ->where('assessment_type_id', $examPaperMarkCriteria->assessment_type_id)
                                                        ->get();

        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        $assessmentTypes = AssessmentType::where('active',1)->pluck('assessment_type', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $assessmentResultCodes = AssessmentResultCode::selectRaw('concat(result_code, concat("-",result_code_description)) as result_code, id')->pluck('result_code', 'id')->all();

        $examPapers = ExamPaper::where('module_id', $examPaperMarkCriteria->module_id)
                                ->where('academic_year_id', $examPaperMarkCriteria->academic_year_id)
                                ->where('assessment_type_id', $examPaperMarkCriteria->assessment_type_id)
                                ->get();

        return view('pages.settings.exam_paper_mark_criterias.edit', compact('examPaperMarkCriterias', 'modules', 'assessmentTypes', 'academicYears', 'assessmentResultCodes', 'examPapers'));
    }

    /**
     * Update the specified study mode in the storage.
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
            
            ExamPaperMarkCriteria::where('module_id', $data['module_id'])
                ->where('academic_year_id', $data['academic_year_id'])
                ->where('assessment_type_id', $data['academic_year_id'])
                ->delete();

            foreach ($data['exam_paper_id'] as $key => $exam_paper_id) {
                ExamPaperMarkCriteria::create(
                    [
                        'module_id' => $data['module_id'],
                        'academic_year_id' => $data['academic_year_id'],
                        'assessment_type_id' => $data['assessment_type_id'],
                        'exam_paper_id' => $exam_paper_id,
                        'assessment_result_code_id' => $data['assessment_result_code_id'][$key],
                        'range_from' => $data['range_from'][$key],
                        'range_to' => $data['range_to'][$key],
                        'created_by' => auth()->user()->id
                    ]
                );
            }
            
            return redirect()->route('exam_paper_mark_criterias.exam_paper_mark_criteria.index')
            ->with('success_message', 'Grading Scale was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified study mode from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $assessmentType = AssessmentType::findOrFail($id);
            $assessmentType->delete();

            return redirect()->route('exam_paper_mark_criterias.exam_paper_mark_criteria.index')
            ->with('success_message', 'Assessment Type was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function getModulePapers($moduleId, $assessmentTypeId, $academicYearId){
        $examPapers = ExamPaper::where('module_id', $moduleId)
                                ->where('academic_year_id', $assessmentTypeId)
                                ->where('assessment_type_id', $academicYearId)
                                ->get();

        $assessmentResultCodes = AssessmentResultCode::selectRaw('concat(result_code, concat("-",result_code_description)) as result_code, id')->pluck('result_code', 'id')->all();

        return view('pages.settings.exam_paper_mark_criterias.criteria-tr', compact('examPapers', 'assessmentResultCodes'))->render();
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
            'module_id' => 'required',
            'academic_year_id' => 'required',
            'assessment_type_id' => 'required',
            'exam_paper_id' => 'required',
            'assessment_result_code_id' => 'required',
            'range_from' => 'required',
            'range_to' => 'required'
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
