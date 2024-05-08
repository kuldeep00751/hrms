<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\AssessmentResultCode;
use App\Models\AssessmentType;
use App\Models\ExamModulePaper;
use App\Models\ExamPaper;
use App\Models\Module;
use Exception;
use Illuminate\Http\Request;

class ExamPapersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the qualifications.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $examPapers = ExamPaper::with('module', 'academicYear', 'assessmentType', 'assessmentResultCode')->get();

        return view('pages.settings.exam_papers.index', compact('examPapers', 'academicYears'));
    }

    /**
     * Show the form for creating a new qualification.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();
        
        $assessmentTypes = AssessmentType::where('active',1)->pluck('assessment_type', 'id')->all();

        $assessmentResultCodes = AssessmentResultCode::pluck('result_code_description', 'id')->all();

        return view('pages.settings.exam_papers.create', compact('modules', 'academicYears', 'assessmentTypes', 'assessmentResultCodes'));
    }

    /**
     * Store a new qualification in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);
            
            foreach($data['paper_name'] as $key => $paper){
                
                ExamPaper::create([
                    'module_id' => $data['module_id'],
                    'academic_year_id' => $data['academic_year_id'],
                    'assessment_type_id' => $data['assessment_type_id'],
                    'minimum_pass_mark' => $data['minimum_pass_mark'][$key],
                    'paper_name' => $paper,
                    'weight' => $data['weight'][$key],
                    'assessment_result_code_id' => $data['assessment_result_code_id']
                ]);
            }

            return redirect()->route('exam_papers.exam_paper.index')
                ->with('success_message', 'Exam paper was successfully added.');

        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified qualification.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $examPaper = ExamPaper::with('module', 'academicYear')->findOrFail($id);

        return view('pages.settings.exam_papers.show', compact('examPaper'));
    }

    /**
     * Show the form for editing the specified qualification.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $examPaper = ExamPaper::with('module', 'academicYear')->findOrFail($id);

        $examPapers = ExamPaper::where('module_id', $examPaper->module_id)
                                ->where('academic_year_id', $examPaper->academic_year_id)
                                ->where('assessment_type_id', $examPaper->assessment_type_id)
                                ->get();

        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $assessmentTypes = AssessmentType::where('active',1)->pluck('assessment_type', 'id')->all();

        $assessmentResultCodes = AssessmentResultCode::pluck('result_code_description', 'id')->all();

        return view('pages.settings.exam_papers.edit', compact('examPaper', 'modules', 'academicYears', 'assessmentTypes', 'assessmentResultCodes', 'examPapers'));
    }

    /**
     * Update the specified qualification in the storage.
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

            $totalWeight = array_sum($data['weight']);
            
            if($totalWeight != 100){
                return back()->withInput()
                ->withErrors(['unexpected_error' => 'Error saving record! The total weight cannot be less or more than 100%. All paper weights put together should be equal to 100%']);
            }

            $examPaper = ExamPaper::findOrFail($id);

            $examPapers = ExamPaper::where('module_id', $examPaper->module_id)
                                ->where('academic_year_id', $examPaper->academic_year_id)
                                ->where('assessment_type_id', $examPaper->assessment_type_id)
                                ->get();
            
            foreach ($data['paper_name'] as $key => $paper_name) {
                
               $paper = $examPapers->find($request->paper[$key]);
                
               if($paper){
                    $paper->minimum_pass_mark = $data['minimum_pass_mark'][$key];
                    $paper->paper_name = $paper_name;
                    $paper->weight = $data['weight'][$key];
                    $paper->assessment_result_code_id = $data['assessment_result_code_id'];
                    $paper->save();
               } else {
                
                    ExamPaper::create([
                        'module_id' => $data['module_id'],
                        'academic_year_id' => $data['academic_year_id'],
                        'assessment_type_id' => $data['assessment_type_id'],
                        'minimum_pass_mark' => $data['minimum_pass_mark'][$key],
                        'paper_name' => $paper_name,
                        'weight' => $data['weight'][$key],
                        'assessment_result_code_id' => $data['assessment_result_code_id']
                    ]);
                }
            }

            return redirect()->route('exam_papers.exam_paper.index')
                ->with('success_message', 'Exam paper was successfully updated.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function copy(Request $request){
        try {
            $fromExamPapers = ExamPaper::where('academic_year_id', $request->from_academic_year_id)->get();

            if(!count($fromExamPapers)){
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'The selected from academic year does not have any exam paper data.']);
            }

            $toExamPapers = ExamPaper::where('academic_year_id', $request->to_academic_year_id)->get();

            foreach($fromExamPapers as $fromExamPaper){
                $toExamPaper = $toExamPapers->where('module_id', $fromExamPaper->module_id);
                
                if(!count($toExamPaper)){
                    ExamPaper::create([
                        'module_id' => $fromExamPaper->module_id,
                        'academic_year_id' => $request->to_academic_year_id,
                        'assessment_type_id' => $fromExamPaper->assessment_type_id,
                        'minimum_pass_mark' => $fromExamPaper->minimum_pass_mark,
                        'paper_name' => $fromExamPaper->paper_name,
                        'weight' => $fromExamPaper->weight,
                        'assessment_result_code_id' => $fromExamPaper->assessment_result_code_id
                    ]);
                }
            }

            return redirect()->route('exam_papers.exam_paper.index')
                ->with('success_message', 'Exam paper was successfully updated.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }

    }

    public function deleteExamPaper($id){
        $paperMarks = ExamModulePaper::where('exam_paper_id', $id)->get();

        if(count($paperMarks)){
            return response()->json([
                'status' => 0,
                'message' => "Paper mark cannot be deleted. Marks have already been captured in this paper."
            ]);
        }

        ExamPaper::destroy($id);

        return response()->json([
            'status' => 1
        ]);
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
            'minimum_pass_mark' => 'required',
            'paper_name' => 'required',
            'weight' => 'required',
            'assessment_result_code_id' => 'required',
        ];

        $data = $request->validate($rules);

        return $data;
    }

}
