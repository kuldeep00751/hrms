<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\AssessmentType;
use App\Models\ExamRegistrationCriteria;
use App\Models\Module;
use Exception;
use Illuminate\Http\Request;

class ExamRegistrationCriteriaController extends Controller
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
        $examRegistrationCriterias = ExamRegistrationCriteria::with('academicYear', 'assessmentType','requiredAssessmentType')->get();

        return view('pages.settings.exam_registration_criterias.index', compact('examRegistrationCriterias'));
    }

    /**
     * Show the form for creating a new study mode.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $assessmentTypes = AssessmentType::where('active',1)->get();
        
        $toBeRegisteredAssessmentType = $assessmentTypes->where('default', '<>', 1)
                                                        ->pluck('assessment_type', 'id')
                                                        ->all();

        $requiredAssessmentTypes = $assessmentTypes->pluck('assessment_type', 'id')->all();

        $assessmentMarkTypes = [
            'Exam' => 'Exam Mark',
            'Final' => 'Final Mark'
        ];

        return view('pages.settings.exam_registration_criterias.create', compact('toBeRegisteredAssessmentType', 'academicYears', 'assessmentMarkTypes', 'requiredAssessmentTypes'));
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
            
            $examRegistrationCriteria = ExamRegistrationCriteria::where('academic_year_id', $data['academic_year_id'])
                                                                ->where('assessment_type_id', $data['assessment_type_id'])
                                                                ->where('required_assessment_mark', $data['required_assessment_mark'])
                                                                ->first();

            if($examRegistrationCriteria){
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'The selected exam registration criteria already exists.']);
            }


            if($data['assessment_type_id'] === $data['required_assessment_exam_id']){
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'The selected exam type cannot be same as required exam type.']);

            }

            $selectedAssessmentType = AssessmentType::where('id', $data['assessment_type_id'])
                                                    ->first();

            if($selectedAssessmentType->default){
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'The selected exam type cannot be same as default exam type.']);
            }

            ExamRegistrationCriteria::create($data);

            return redirect()->route('exam_registration_criterias.exam_registration_criteria.index')
            ->with('success_message', 'Exam registration criteria was successfully added.');
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
        $examAdmissionCriteria = ExamRegistrationCriteria::findOrFail($id);

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
        $examRegistrationCriteria = ExamRegistrationCriteria::findOrFail($id);

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $assessmentTypes = AssessmentType::where('active', 1)->get();

        $toBeRegisteredAssessmentType = $assessmentTypes->where('default', '<>', 1)
            ->pluck('assessment_type', 'id')
            ->all();

        $requiredAssessmentTypes = $assessmentTypes->pluck('assessment_type', 'id')->all();

        $assessmentMarkTypes = [
            'Exam' => 'Exam Mark',
            'Final' => 'Final Mark'
        ];


        return view('pages.settings.exam_registration_criterias.edit', compact('examRegistrationCriteria', 'assessmentTypes', 'academicYears', 'assessmentMarkTypes', 'toBeRegisteredAssessmentType', 'requiredAssessmentTypes'));
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

            $examRegistrationCriteria = ExamRegistrationCriteria::findOrFail($id);

            $examRegistrationCriteria->update($data);

            return redirect()->route('exam_registration_criterias.exam_registration_criteria.index')
            ->with('success_message', 'Exam registration criteria was successfully updated.');
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
            'academic_year_id' => 'required',
            'assessment_type_id' => 'required',
            'required_assessment_mark' => 'required',
            'required_assessment_exam_id' => 'required',
            'minimum_mark' => 'required',
            'maximum_mark' => 'required',
        ];

        $data = $request->validate($rules);


        return $data;
    }
}
