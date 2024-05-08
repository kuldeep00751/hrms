<?php

namespace App\Http\Controllers;

use App\Models\AcademicIntake;
use App\Models\AcademicYear;
use App\Models\AssessmentSuppression;
use App\Models\Campus;
use App\Models\StudyMode;
use Exception;
use Illuminate\Http\Request;

class AssessmentSuppressionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $suppressionTypes = [
            'CA' => 'CA Marks',
            'Exam Marks' => 'Exam Marks',
            'Final Mark' => 'Final Marks',
        ];

        $filterData = $this->filterData($request);

        $assessmentSuppressions = AssessmentSuppression::with('academicYear', 'academicIntake', 'studyMode', 'campus')->orderBy('academic_year_id', 'desc')->paginate(25);

        return view('pages.assessments.suppressions.index', compact('academicYears', 'academicIntakes', 'studyModes', 'campuses', 'filterData', 'assessmentSuppressions', 'suppressionTypes'));
    }

    private function filterData($request)
    {
        if (count($request->all())) {
            return $request->all();
        } else {
            return [
                'academic_year_id' => 0,
                'academic_intake_id' => 0,
                'campus_id' => 0,
                'study_mode_id' => 0,
                'suppresion_type' => ''
            ];
        }
    }

    public function filter(Request $request)
    {

        $data = $request->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $suppressionTypes = [
            'CA' => 'CA Marks',
            'Exam Marks' => 'Exam Marks',
            'Final Mark' => 'Final Marks',
        ];

        $filterData = $this->filterData($request);

        session()->put($filterData);

        $assessmentSuppressions = AssessmentSuppression::with('academicYear', 'academicIntake', 'studyMode', 'campus');

        $assessmentSuppressions = $this->applyFilters($assessmentSuppressions, $request);

        return view('pages.assessments.suppressions.index', compact('academicYears', 'academicIntakes', 'studyModes', 'suppressionTypes', 'campuses', 'filterData', 'assessmentSuppressions'));
    }

    private function applyFilters($assessmentSuppressions, $request)
    {

        if (isset($request->academic_year_id)) {
            $moduleRegistrations = $assessmentSuppressions->where('academic_year_id', $request->academic_year_id);
        }

        if (isset($request->academic_intake_id)) {
            $assessmentSuppressions = $assessmentSuppressions->where('academic_intake_id', $request->academic_intake_id);
        }

        if (isset($request->campus_id)) {
            $assessmentSuppressions = $assessmentSuppressions->where('campus_id', $request->campus_id);
        }

        if (isset($request->study_mode_id)) {
            $assessmentSuppressions = $assessmentSuppressions->where('study_mode_id', $request->study_mode_id);
        }

        if (isset($request->suppression_type)) {
            $assessmentSuppressions = $assessmentSuppressions->where('suppression_type', $request->suppression_type);
        }

        return $assessmentSuppressions->get();
    }

    public function create()
    {
        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $suppressionTypes = [
            'CA' => 'CA Marks',
            'Exam Marks' => 'Exam Marks',
            'Final Mark' => 'Final Marks',
        ];

        return view('pages.assessments.suppressions.create', compact('academicYears', 'academicIntakes', 'studyModes', 'suppressionTypes', 'campuses'));
    }

    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            AssessmentSuppression::create($data);

            return redirect()->route('assessments.suppressions.index')
            ->with('success_message', 'Marks suppressions was successfully added.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function suppress(Request $request)
    {
        
        $assessmentSuppression = AssessmentSuppression::find($request->id);
        
        $assessmentSuppression->suppress_yn = $request->suppress_yn;
        
        $assessmentSuppression->save();

        return response()->json(array('success_message' => 'Suppression was successfully added.'), 200);
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
            'study_mode_id' => 'required',
            'academic_intake_id' => 'required',
            'campus_id' => 'required',
            'suppression_type' => 'required',
            'created_by' => 'required',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
