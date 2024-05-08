<?php

namespace App\Http\Controllers;

use App\Models\AcademicIntake;
use App\Models\AcademicYear;
use App\Models\AssessmentType;
use App\Models\Campus;
use App\Models\ExamModulePaper;
use App\Models\ExamPaper;
use App\Models\ExamRegistrationCriteria;
use App\Models\Module;
use App\Models\ModuleRegistration;
use App\Models\StudentAccount;
use App\Models\StudentExamination;
use App\Models\StudentFinalMark;
use App\Models\StudyMode;
use App\Models\StudyPeriod;
use App\Models\SubjectFee;
use App\Models\UserInfo;
use Exception;
use Illuminate\Http\Request;

class ExamRegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        $studyPeriods = StudyPeriod::pluck('study_period', 'id')->all();

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $assessmentTypes = AssessmentType::select('assessment_type', 'id')
                                        ->where('default', '<>', 1)
                                        ->pluck('assessment_type', 'id')
                                        ->all();

        $students = array();

        $filterData = array();
        
        return view('pages.assessments.exam_registration.index', compact('students','academicYears', 'academicIntakes', 'modules', 'studyModes', 'filterData', 'campuses', 'studyPeriods', 'assessmentTypes'));
    
    }

    

    public function filter(Request $request)
    {

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        $studyPeriods = StudyPeriod::pluck('study_period', 'id')->all();

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();


        $assessmentTypes = AssessmentType::select('assessment_type', 'id')
                                    ->where('default','<>', 1)
                                    ->pluck('assessment_type', 'id')
                                    ->all();

        $filterData = $this->filterData($request);

        
        $examRegistrationCriterias = ExamRegistrationCriteria::where('assessment_type_id', $filterData['assessment_type_id'])
                                                            ->where('academic_year_id', $filterData['academic_year'])
                                                            ->get();

        if (!count($examRegistrationCriterias)) {
            return redirect()->back()->withInput()
                ->withErrors(['unexpected_error' => 'Exam registration criteria not found. Please define exam registration criteria in control panel.']);
        }
        
        
        foreach ($examRegistrationCriterias as $examRegistrationCriteria) {

            switch ($examRegistrationCriteria->required_assessment_mark) {
                case 'Exam':
                    $studentExaminations = StudentExamination::with('userInfo', 'academicYear', 'academicIntake', 'campus', 'studyMode', 'module')
                        ->select('user_info_id', 'module_id', 'academic_year_id', 'academic_intake_id','study_mode_id', 'campus_id','assessment_type_id', 'exam_mark as mark', 'pass_fail')
                        ->where('module_id', $filterData['module'])
                        ->where('academic_year_id', $filterData['academic_year'])
                        ->where('assessment_type_id', $examRegistrationCriteria->required_assessment_exam_id)
                        ->where('academic_intake_id', $filterData['academic_intake'])
                        ->where('campus_id', $filterData['campus'])
                        ->where('study_mode_id', $filterData['study_mode'])
                        ->whereBetween('exam_mark', [$examRegistrationCriteria->minimum_mark, $examRegistrationCriteria->maximum_mark])
                        ->get();
                    
                        
                    break;
                case 'Final':
                    $studentFinalMarks = StudentFinalMark::with('userInfo', 'academicYear', 'academicIntake', 'campus', 'studyMode', 'module')
                    ->select('user_info_id', 'module_id', 'academic_year_id', 'academic_intake_id', 'study_mode_id', 'campus_id', 'assessment_type_id','final_mark as mark', 'pass_fail')
                    ->where('module_id', $filterData['module'])
                    ->where('academic_year_id', $filterData['academic_year'])
                    ->where('assessment_type_id', $examRegistrationCriteria->required_assessment_exam_id)
                    ->where('academic_intake_id', $filterData['academic_intake'])
                    ->where('campus_id', $filterData['campus'])
                    ->where('study_mode_id', $filterData['study_mode'])
                    ->whereBetween('final_mark', [$examRegistrationCriteria->minimum_mark, $examRegistrationCriteria->maximum_mark])
                    ->get();
                    
                    break;
                default:
                    break;
            }
            
        }

        $students = $studentExaminations->merge($studentFinalMarks)->unique('user_info_id');
        
        return view('pages.assessments.exam_registration.index', compact('students', 'academicYears', 'academicIntakes', 'modules', 'studyPeriods', 'studyModes', 'filterData', 'campuses', 'assessmentTypes'));
    }

    private function filterData($request)
    {
        
        $academic_year = session()->get('academic_year');
        $academic_intake = session()->get('academic_intake');
        $module = session()->get('module');
        $study_period = session()->get('study_period');
        $study_mode = session()->get('study_mode');
        $campus = session()->get('campus');
        $student_number = session()->get('student_number');
        $assessment_type_id = session()->get('assessment_type_id');

        if (count($request->all())) {

            session()->put('academic_year', $request->academic_year);
            session()->put('academic_intake', $request->academic_intake);
            session()->put('module', $request->module);
            session()->put('study_period', $request->study_period);
            session()->put('study_mode', $request->study_mode);
            session()->put('campus', $request->campus);
            session()->put('student_number', $request->student_number);
            session()->put('assessment_type_id', $request->assessment_type_id);

            return $request->all();
        } else {
            return [
                'academic_year' => $academic_year,
                'academic_intake' => $academic_intake,
                'module' => $module,
                'study_period' => $study_period,
                'study_mode' => $study_mode,
                'campus' => $campus,
                'student_number' => $student_number,
                'assessment_type_id' => $assessment_type_id
            ];
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $examPapers = ExamPaper::select('id')
                                    ->where('module_id', $request->module_id)
                                    ->where('academic_year_id', $request->academic_year_id)
                                    ->where('assessment_type_id', $request->assessment_type_id)
                                    ->get();
            
            if(!count($examPapers)){
                return redirect()->back()->withInput()
                ->withErrors(['unexpected_error' => 'Exam papers not found for the selected assessment type. Please define exam papers in control panel.']);
            }

            $examModulePapers = ExamModulePaper::where('module_id' , $request->module_id)
                                            ->where('academic_year_id' , $request->academic_year_id)
                                            ->where('study_mode_id' , $request->study_mode_id)
                                            ->where('academic_intake_id' , $request->academic_intake_id)
                                            ->where('assessment_type_id' , $request->assessment_type_id)
                                            ->where('campus_id' , $request->campus_id)
                                            ->get();


            $studentExaminations = StudentExamination::where('module_id', $request->module_id)
                                                    ->where('academic_year_id', $request->academic_year_id)
                                                    ->where('study_mode_id', $request->study_mode_id)
                                                    ->where('academic_intake_id', $request->academic_intake_id)
                                                    ->where('assessment_type_id', $request->assessment_type_id)
                                                    ->where('campus_id', $request->campus_id)
                                                    ->get();

            $studentFinalMarks = StudentFinalMark::where('module_id', $request->module_id)
                                                    ->where('academic_year_id', $request->academic_year_id)
                                                    ->where('study_mode_id', $request->study_mode_id)
                                                    ->where('academic_intake_id', $request->academic_intake_id)
                                                    ->where('assessment_type_id', $request->assessment_type_id)
                                                    ->where('campus_id', $request->campus_id)
                                                    ->get();
                                                    
            $userInfos = UserInfo::whereIn('id', $request->user_info_id)->get();
            
            foreach ($request->user_info_id as $key => $userInfoId) {
                foreach ($examPapers as $examPaper) {

                    $examModulePaper = $examModulePapers->where('user_info_id', $userInfoId)
                                                        ->where('exam_paper_id', $examPaper->id)
                                                        ->first();
                    if(!$examModulePaper){
                        ExamModulePaper::create([
                                'user_info_id' => $userInfoId,
                                'module_id' => $request->module_id,
                                'academic_year_id' => $request->academic_year_id,
                                'study_mode_id' => $request->study_mode_id,
                                'academic_intake_id' => $request->academic_intake_id,
                                'assessment_type_id' => $request->assessment_type_id,
                                'campus_id' => $request->campus_id,
                                'exam_paper_id' => $examPaper->id,
                                'mark' => 0,
                                'pass_fail' => "F",
                                'created_by' => auth()->user()->id,
                        ]);
                    }
                }

                $studentExamination = $studentExaminations->where('user_info_id', $userInfoId)->first();
                
                if(!$studentExamination){
                    
                    StudentExamination::create([
                        'user_info_id' => $userInfoId,
                        'module_id' => $request->module_id,
                        'academic_year_id' => $request->academic_year_id,
                        'study_mode_id' => $request->study_mode_id,
                        'academic_intake_id' => $request->academic_intake_id,
                        'assessment_type_id' => $request->assessment_type_id,
                        'campus_id' => $request->campus_id,
                        'exam_mark' => 0,
                        'pass_fail' => "F",
                        'created_by' => auth()->user()->id,
                    ]);

                    $userInfo = $userInfos->find($userInfoId);
                    
                    $moduleFees = $this->getModuleFee($request->academic_year_id, $request->assessment_type_id, $userInfo->citizenship_status, $request->module_id);

                    $this->chargeExamModuleFees($moduleFees, $userInfoId);
                }

                $studentFinalMark = $studentFinalMarks->where('user_info_id', $userInfoId)->first();

                if (!$studentFinalMark) {

                    StudentFinalMark::create([
                        'user_info_id' => $userInfoId,
                        'module_id' => $request->module_id,
                        'academic_year_id' => $request->academic_year_id,
                        'study_mode_id' => $request->study_mode_id,
                        'academic_intake_id' => $request->academic_intake_id,
                        'assessment_type_id' => $request->assessment_type_id,
                        'campus_id' => $request->campus_id,
                        'final_mark' => 0,
                        'grading_scale_id' => 0,
                        'pass_fail' => "F",
                        'created_by' => auth()->user()->id,
                    ]);
                }
            }

            session()->put('assessmentTypeId', $request->assessment_type_id);

            return redirect()->route('assessments.exam_registration.get-filter')
            ->with('success_message', 'The selected students where successfully registered.');
        } catch (Exception $exception) {
            dd($exception);
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    private function chargeExamModuleFees($moduleFees, $userInfoId)
    {
        foreach ($moduleFees as $fee) {
            StudentAccount::create([
                'user_info_id' => $userInfoId,
                'financial_year_id' => $fee->academic_year_id,
                'reference' => "ExamRegister",
                'transaction_date' => date('Y-m-d'),
                'transaction_description' => $fee->module->module_name,
                'transaction_type' => 'ExamRegistration',
                'model_type' => 'Module',
                'model_id' =>  $fee->module->id,
                'debit' => $fee->amount,
                'credit' => 0
            ]);
        }
    }

    private function getModuleFee($academicYearId, $assessmentTypeId, $studentTypeId, $moduleId){
        return SubjectFee::with('module')
                            ->where('academic_year_id', $academicYearId)
                            ->where('assessment_type_id', $assessmentTypeId)
                            ->where('student_type_id', $studentTypeId)
                            ->where('module_id', $moduleId)
                            ->get();
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
