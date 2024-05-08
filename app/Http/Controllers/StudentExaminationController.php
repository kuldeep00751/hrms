<?php

namespace App\Http\Controllers;

use App\Actions\ExamRegistration;
use App\Actions\ProcessExamMarks;
use App\Exports\ExamMarksReport;
use App\Models\AcademicIntake;
use App\Models\AcademicYear;
use App\Models\AssessmentType;
use App\Models\AttendanceRegister;
use App\Models\Campus;
use App\Models\ExamAdmissionCriteria;
use App\Models\ExamMarkCriteria;
use App\Models\ExamModulePaper;
use App\Models\ExamPaper;
use App\Models\FinalMarkCriteria;
use App\Models\Module;
use App\Models\ModuleAllocation;
use App\Models\ModuleRegistration;
use App\Models\StudentCa;
use App\Models\StudentExamination;
use App\Models\StudyMode;
use Excel;
use Illuminate\Http\Request;

class StudentExaminationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = auth()->user();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $assessmentTypes = AssessmentType::where('active',1)->pluck('assessment_type', 'id')->all();

        $filterData = $this->filterData($request);

        $lecturerModules = array();

        return view('pages.assessments.examinations.index', compact('academicYears', 'filterData', 'lecturerModules', 'assessmentTypes'));
    }

    private function filterData($request)
    {
        if (count($request->all())) {
            return $request->all();
        } else {
            return [
                'academic_year_id' => 0,
                'assessment_type_id' => 0,
            ];
        }
    }

    public function filter(Request $request)
    {
        
        $data = $this->getData($request);
        
        $user = auth()->user();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $assessmentTypes = AssessmentType::where('active',1)->pluck('assessment_type', 'id')->all();

        $filterData = $this->filterData($request);
        
        session()->put($filterData);

        $lecturerModules = ModuleAllocation::where('user_id', $user->id)
                                            ->where('academic_year_id', $filterData['academic_year_id'])
                                            ->get();
        
        $examPapers = ExamPaper::whereIn('module_id', $lecturerModules->pluck('module_id'))
                                ->whereIn('academic_year_id', $lecturerModules->pluck('academic_year_id'))
                                ->where('assessment_type_id', $filterData['assessment_type_id'])
                                ->get();
        
        $examType = AssessmentType::find($filterData['assessment_type_id']);
        
        return view('pages.assessments.examinations.index', compact('academicYears', 'filterData', 'examPapers', 'assessmentTypes', 'lecturerModules', 'examType'));
    }

    public function showExam($moduleAllocationId, $examPaperId, $assessmentTypeId)
    {
        $lecturerModule = ModuleAllocation::find($moduleAllocationId);

        $examPaper = ExamPaper::findOrFail($examPaperId);

        $examAdmissionCriteria = ExamAdmissionCriteria::where('module_id', $lecturerModule->module_id)
                                                        ->where('academic_year_id', $lecturerModule->academic_year_id)
                                                        ->where('assessment_type_id', $assessmentTypeId)
                                                        ->first();
        
        if (!$examAdmissionCriteria) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Exam admission criteria not defined.']);
        }

        if ($examAdmissionCriteria->absent_exam_result_code === "") {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Absent from exam result code for this module not set. Please define it under Settings.']);
        }

        $examMarkCriterias = ExamMarkCriteria::where('module_id', $lecturerModule->module_id)
                                            ->where('academic_year_id', $lecturerModule->academic_year_id)
                                            ->where('assessment_type_id', $assessmentTypeId)
                                            ->get();
        if (!count($examMarkCriterias)) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Exam mark criteria/grading scale not defined. Please define exam mark grading before proceeding.']);
        }

        $finalMarkCriterias = FinalMarkCriteria::where('module_id', $lecturerModule->module_id)
            ->where('academic_year_id', $lecturerModule->academic_year_id)
            ->where('assessment_type_id', $assessmentTypeId)
            ->get();

        if (!count($finalMarkCriterias)) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Final mark criteria/grading scale not defined. Please define final mark grading before proceeding.']);
        }

        $assessmentType = AssessmentType::find($assessmentTypeId);


        if (!$assessmentType->default) {
            $qualifiedStudents = StudentExamination::where('academic_year_id', $lecturerModule->academic_year_id)
                                            ->where('academic_intake_id', $lecturerModule->academic_intake_id)
                                            ->where('study_mode_id', $lecturerModule->study_mode_id)
                                            ->where('module_id', $lecturerModule->module_id)
                                            ->where('campus_id', $lecturerModule->campus_id)
                                            ->where('assessment_type_id', $assessmentTypeId)
                                            ->pluck('user_info_id', 'user_info_id');
            
                                            
        } else {
            
            $qualifiedStudents = $this->getQualifiedStudents($examAdmissionCriteria, $lecturerModule);
            
        }

        
        
        $moduleRegistrations = ModuleRegistration::with('academicYear', 'academicIntake', 'studyMode', 'module', 'campus')
                                                ->where('academic_year_id', $lecturerModule->academic_year_id)
                                                ->where('academic_intake_id', $lecturerModule->academic_intake_id)
                                                ->where('study_mode_id', $lecturerModule->study_mode_id)
                                                ->where('module_id', $lecturerModule->module_id)
                                                ->where('campus_id', $lecturerModule->campus_id)
                                                ->whereIn('user_info_id', $qualifiedStudents)
                                                ->join('user_infos', 'user_infos.id', '=', 'module_registrations.user_info_id')
                                                ->orderBy('user_infos.surname')
                                                ->get();
        //dd($moduleRegistrations);
        if(!count($moduleRegistrations)){
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'There are no students available to enter exam marks.']);
        }

        $examModulePaper = ExamModulePaper::where('module_id', $lecturerModule->module_id)
            ->where('academic_year_id', $lecturerModule->academic_year_id)
            ->where('assessment_type_id', $assessmentTypeId)
            ->where('study_mode_id', $lecturerModule->study_mode_id)
            ->where('academic_intake_id', $lecturerModule->academic_intake_id)
            ->where('campus_id', $lecturerModule->campus_id)
            ->where('exam_paper_id', $examPaperId)
            ->get();

        return view('pages.assessments.examinations.papers', compact('moduleRegistrations', 'examPaper', 'examModulePaper', 'assessmentTypeId', 'lecturerModule', 'assessmentType'));
    }

    private function getQualifiedStudents($examAdmissionCriteria, $lecturerModule){
        
        //Get qualified students based on CA marks
        $studentCas =  StudentCa::select('user_info_id')
                            ->where('academic_year_id', $lecturerModule->academic_year_id)
                            ->where('academic_intake_id', $lecturerModule->academic_intake_id)
                            ->where('study_mode_id', $lecturerModule->study_mode_id)
                            ->where('campus_id', $lecturerModule->campus_id)
                            ->where('module_id', $lecturerModule->module_id)
                            ->where('ca_mark', '>=', $examAdmissionCriteria->minimum_ca_mark)
                            ->pluck('user_info_id', 'user_info_id');
        
        //Get qualified students based on hours attended.
        $attendanceRegisters = AttendanceRegister::selectRaw('user_info_id, sum(attendance_duration) as attendance')
                                ->join('attendance_register_students','attendance_register_students.attendance_register_id', '=', 'attendance_registers.id')
                                ->where('academic_year_id',$lecturerModule->academic_year_id)
                                ->where('academic_intake_id', $lecturerModule->academic_intake_id)
                                ->where('campus_id', $lecturerModule->campus_id)
                                ->where('module_id', $lecturerModule->module_id)
                                ->where('study_mode_id', $lecturerModule->study_mode_id)
                                ->whereIn('user_info_id', $studentCas)
                                ->groupBy('user_info_id')
                                ->get();
        
        if($examAdmissionCriteria->minimum_attendance == 0){
            return $studentCas;
        }
        
        $students = $attendanceRegisters->where('attendance', '>=', $examAdmissionCriteria->minimum_attendance)->pluck('user_info_id', 'user_info_id');
        
        return $students;
    }

    public function viewAll($moduleAllocationId, $assessmentTypeId)
    {
        $moduleAllocation = ModuleAllocation::find($moduleAllocationId);

        $moduleRegistrations = ModuleRegistration::with('academicYear', 'academicIntake', 'studyMode', 'module', 'campus')
                                                ->where('academic_year_id', $moduleAllocation->academic_year_id)
                                                ->where('is_exempted', 0)
                                                ->where('is_cancelled', 0)
                                                ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
                                                ->where('study_mode_id', $moduleAllocation->study_mode_id)
                                                ->where('module_id', $moduleAllocation->module_id)
                                                ->where('campus_id', $moduleAllocation->campus_id)
                                                ->join('user_infos', 'user_infos.id', '=', 'module_registrations.user_info_id')
                                                ->orderBy('user_infos.surname')
                                                ->get();


        $examModulePaper = ExamModulePaper::where('module_id', $moduleAllocation->module_id)
                                    ->where('academic_year_id', $moduleAllocation->academic_year_id)
                                    ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
                                    ->where('assessment_type_id', $assessmentTypeId)
                                    ->where('study_mode_id', $moduleAllocation->study_mode_id)
                                    ->where('campus_id', $moduleAllocation->campus_id)
                                    ->get();

        $studentExaminations = StudentExamination::where('module_id', $moduleAllocation->module_id)
                                                ->where('academic_year_id', $moduleAllocation->academic_year_id)
                                                ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
                                                ->where('assessment_type_id', $assessmentTypeId)
                                                ->where('study_mode_id', $moduleAllocation->study_mode_id)
                                                ->where('campus_id', $moduleAllocation->campus_id)
                                                ->get();

        $examPapers = ExamPaper::select('paper_name', 'id')
                                ->where('module_id', $moduleAllocation->module_id)
                                ->where('academic_year_id', $moduleAllocation->academic_year_id)
                                ->where('assessment_type_id', $assessmentTypeId)
                                ->get();

        $assessmentType = AssessmentType::find($assessmentTypeId);


        return view('pages.assessments.examinations.report', compact('examModulePaper', 'examPapers', 'moduleRegistrations', 'moduleAllocation', 'studentExaminations', 'assessmentType'));
    }
    public function downloadExamReport($moduleAllocationId, $assessmentTypeId)
    {
        $moduleAllocation = ModuleAllocation::find($moduleAllocationId);
        session()->put('moduleAllocation', $moduleAllocation);

        $moduleRegistrations = ModuleRegistration::with('academicYear', 'academicIntake', 'studyMode', 'module', 'campus')
            ->where('academic_year_id', $moduleAllocation->academic_year_id)
            ->where('is_exempted', 0)
            ->where('is_cancelled', 0)
            ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
            ->where('study_mode_id', $moduleAllocation->study_mode_id)
            ->where('module_id', $moduleAllocation->module_id)
            ->where('campus_id', $moduleAllocation->campus_id)
            ->join('user_infos', 'user_infos.id', '=', 'module_registrations.user_info_id')
            ->orderBy('user_infos.surname')
            ->get();
        session()->put('moduleRegistrations', $moduleRegistrations);


        $examModulePaper = ExamModulePaper::where('module_id', $moduleAllocation->module_id)
            ->where('academic_year_id', $moduleAllocation->academic_year_id)
            ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
            ->where('assessment_type_id', $assessmentTypeId)
            ->where('study_mode_id', $moduleAllocation->study_mode_id)
            ->where('campus_id', $moduleAllocation->campus_id)
            ->get();
        session()->put('examModulePaper', $examModulePaper);

        $studentExaminations = StudentExamination::where('module_id', $moduleAllocation->module_id)
            ->where('academic_year_id', $moduleAllocation->academic_year_id)
            ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
            ->where('assessment_type_id', $assessmentTypeId)
            ->where('study_mode_id', $moduleAllocation->study_mode_id)
            ->where('campus_id', $moduleAllocation->campus_id)
            ->get();
        session()->put('studentExaminations', $studentExaminations);

        $examPapers = ExamPaper::select('paper_name', 'id')
            ->where('module_id', $moduleAllocation->module_id)
            ->where('academic_year_id', $moduleAllocation->academic_year_id)
            ->where('assessment_type_id', $assessmentTypeId)
            ->get();
        session()->put('examPapers', $examPapers);

        $assessmentType = AssessmentType::find($assessmentTypeId);
        session()->put('assessmentType', $assessmentType);

        $filename = $moduleAllocation->module->module_name . "exam_marks_report";


        return Excel::download(new ExamMarksReport, $filename . '' . '.xlsx');
    }

    public function store(Request $request, ProcessExamMarks $examMarks, ExamRegistration $examRegistration)
    {

        $examModulePaper = ExamModulePaper::where('module_id', $request->module_id)
            ->where('academic_year_id', $request->academic_year_id)
            ->where('academic_intake_id', $request->academic_intake_id)
            ->where('assessment_type_id', $request->assessment_type_id)
            ->where('study_mode_id', $request->study_mode_id)
            ->where('campus_id', $request->campus_id)
            ->where('exam_paper_id', $request->exam_paper_id)
            ->whereIn('user_info_id', $request->user_info_id)
            ->get();
        
        $examPaper = ExamPaper::find($request->exam_paper_id);

        $passFail = '';
        
        foreach ($request->user_info_id as $key => $userInfoId) {
            $studentMark = $examModulePaper->where('user_info_id', $userInfoId)->first();
            
            if($request->mark[$userInfoId] < $examPaper->minimum_pass_mark){
                $passFail = 'F';
            } else {
                $passFail = 'P';
            }
            
            if ($studentMark) {
                $studentMark->mark = $request->mark[$userInfoId];
                $studentMark->updated_by = auth()->user()->id;
                $studentMark->pass_fail = $passFail;
                $studentMark->save();
            } else {
                
                ExamModulePaper::create([
                    'user_info_id' => $userInfoId,
                    'module_id' => $request->module_id,
                    'academic_year_id' => $request->academic_year_id,
                    'academic_intake_id' => $request->academic_intake_id,
                    'assessment_type_id' => $request->assessment_type_id,
                    'study_mode_id' => $request->study_mode_id,
                    'campus_id' => $request->campus_id,
                    'exam_paper_id' => $request->exam_paper_id,
                    'mark' => $request->mark[$userInfoId],
                    'pass_fail' => $passFail,
                    'created_by' => auth()->user()->id
                ]);
            }

        }
        
        $examMarks->process($request);

        //Register exam
        $examRegistration->registerExam($request, "Exam");

        $moduleRegistrations = ModuleRegistration::where('academic_year_id', $request->academic_year_id)
                                                ->where('academic_intake_id', $request->academic_intake_id)
                                                ->where('study_mode_id', $request->study_mode_id)
                                                ->where('campus_id', $request->campus_id)
                                                ->where('module_id', $request->module_id)
                                                ->whereIn('user_info_id', $request->user_info_id)
                                                ->where('is_cancelled', 0)
                                                ->where('is_exempted', 0)
                                                ->with('examModulePapers')
                                                ->get();

        $this->createStudentModulePapers($request->assessment_type_id, $moduleRegistrations);

        return redirect()->route('assessments.exams.show', [$request->module_allocation_id, $request->exam_paper_id, $request->assessment_type_id])
            ->with('success_message', 'Students paper marks successfully saved');
    }

    private function createStudentModulePapers($assessmentTypeId, $moduleRegistrations){

        $examPapers = ExamPaper::where('module_id', $moduleRegistrations->first()->module_id)
                                ->where('academic_year_id', $moduleRegistrations->first()->academic_year_id)
                                ->where('assessment_type_id', $assessmentTypeId)
                                ->get();

        
        foreach($moduleRegistrations as $moduleRegistration){

            foreach ($examPapers as $examPaper) {

                $examModulePaper = $moduleRegistration
                                ->examModulePapers
                                ->where('assessment_type_id', $assessmentTypeId)
                                ->where('user_info_id', $moduleRegistration->user_info_id)
                                ->where('exam_paper_id', $examPaper->id)
                                ->first();

                if(!$examModulePaper){
                    ExamModulePaper::create([
                        'user_info_id' => $moduleRegistration->user_info_id,
                        'module_id' => $moduleRegistration->module_id,
                        'academic_year_id' => $moduleRegistration->academic_year_id,
                        'academic_intake_id' => $moduleRegistration->academic_intake_id,
                        'assessment_type_id' => $assessmentTypeId,
                        'study_mode_id' => $moduleRegistration->study_mode_id,
                        'campus_id' => $moduleRegistration->campus_id,
                        'exam_paper_id' => $examPaper->id,
                        'mark' => 0,
                        'pass_fail' => 'F',
                        'created_by' => auth()->user()->id
                    ]);
                }
            }
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
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
