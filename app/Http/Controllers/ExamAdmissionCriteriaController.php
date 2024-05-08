<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\AssessmentResultCode;
use App\Models\AssessmentType;
use App\Models\ExamAdmissionCriteria;
use App\Models\Module;
use Exception;
use Illuminate\Http\Request;

class ExamAdmissionCriteriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the study modes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $examAdmissionCriterias = ExamAdmissionCriteria::with('module', 'academicYear', 'assessmentResultCode', 'assessmentType')->get();

        return view('pages.settings.exam_admission_criterias.index', compact('examAdmissionCriterias'));
    }

    /**
     * Show the form for creating a new study mode.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {

        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $assessmentTypes = AssessmentType::where('active', 1)->pluck('assessment_type', 'id')->all();

        $assessmentResultCodes = AssessmentResultCode::pluck('result_code_description', 'id')->all();
        
        return view('pages.settings.exam_admission_criterias.create', compact('modules', 'academicYears', 'assessmentResultCodes', 'assessmentTypes'));
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
            
            ExamAdmissionCriteria::create($data);

            return redirect()->route('exam_admission_criterias.exam_admission_criteria.index')
            ->with('success_message', 'Exam admission criteria was successfully added.');
        } catch (Exception $exception) {
            
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
        $examAdmissionCriteria = ExamAdmissionCriteria::findOrFail($id);

        return view('pages.settings.exam_admission_criterias.show', compact('examAdmissionCriteria'));
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
        $examAdmissionCriteria = ExamAdmissionCriteria::findOrFail($id);

        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $assessmentTypes = AssessmentType::where('active', 1)->pluck('assessment_type', 'id')->all();

        $assessmentResultCodes = AssessmentResultCode::pluck('result_code_description', 'id')->all();

        return view('pages.settings.exam_admission_criterias.edit', compact('examAdmissionCriteria', 'modules', 'academicYears', 'assessmentResultCodes', 'assessmentTypes'));
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
            
            $examAdmissionCriteria = ExamAdmissionCriteria::findOrFail($id);

            $examAdmissionCriteria->update($data);

            return redirect()->route('exam_admission_criterias.exam_admission_criteria.index')
                            ->with('success_message', 'Exam admission criteria was successfully updated.');
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
            'module_id' => 'required',
            'academic_year_id' => 'required',
            'minimum_ca_mark' => 'required',
            'ca_weight' => 'required',
            'exam_weight' => 'required',
            'updated_by' => 'required',
            'created_by' => 'required',
            'assessment_result_code_id' => 'required',
            'assessment_type_id' => 'required',
            'minimum_attendance' => 'required',
            'absent_exam_indicator' => 'nullable',
            'absent_exam_result_code' => 'required',
        ];

        $data = $request->validate($rules);
        
        return $data;
    }
}
