<?php

namespace App\Http\Controllers;

use App\Actions\Helper;
use App\Exports\FinalMarksReport;
use App\Models\AcademicIntake;
use App\Models\AcademicYear;
use App\Models\AssessmentResultCode;
use App\Models\AssessmentType;
use App\Models\Campus;
use App\Models\ExamAdmissionCriteria;
use App\Models\ExamPaper;
use App\Models\FinalMarkCriteria;
use App\Models\Module;
use App\Models\ModuleAllocation;
use App\Models\ModuleRegistration;
use App\Models\StudyMode;
use App\Models\StudentCa;
use App\Models\StudentExamination;
use App\Models\StudentFinalMark;
use Excel;
use Exception;
use Illuminate\Http\Request;

class StudentFinalMarkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = auth()->user();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $assessmentTypes = AssessmentType::where('active',1)->pluck('assessment_type', 'id')->all();

        $filterData = $this->filterData($request);

        $lecturerModules = array();

        return view('pages.assessments.final_marks.index', compact('academicYears', 'filterData', 'lecturerModules', 'assessmentTypes'));
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

    public function filter(Request $request, Helper $helper){
        
        $academicYears = AcademicYear::pluck('name', 'id')->all();
        
        $user = auth()->user();

        $assessmentTypes = AssessmentType::where('active',1)->pluck('assessment_type', 'id')->all();

        $filterData = $this->filterData($request);
        
        session()->put($filterData);

        $lecturerModules = ModuleAllocation::where('user_id', $user->id)
                                            ->where('academic_year_id', $filterData['academic_year_id'])
                                            ->get();

        $examType = AssessmentType::find($filterData['assessment_type_id']);

        $processFinalMarksAcademicProcess = $helper->processFinalMarksAcademicProcess($filterData['academic_year_id']);
        
        return view('pages.assessments.final_marks.index', compact('academicYears', 'filterData', 'lecturerModules', 'examType', 'assessmentTypes', 'processFinalMarksAcademicProcess'));
    }

    public function processReportView($moduleAllocationId, $assessmentTypeId){
        
        $moduleAllocation = ModuleAllocation::find($moduleAllocationId);

        $studentFinalMarks = StudentFinalMark::with('assessmentResultCode')
                                            ->where('academic_year_id', $moduleAllocation->academic_year_id)
                                            ->where('module_id', $moduleAllocation->module_id)
                                            ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
                                            ->where('assessment_type_id', $assessmentTypeId)
                                            ->where('campus_id', $moduleAllocation->campus_id)
                                            ->where('assessment_type_id', $assessmentTypeId)
                                            ->where('study_mode_id', $moduleAllocation->study_mode_id)
                                            ->join('user_infos', 'user_infos.id', '=', 'student_final_marks.user_info_id')
                                            ->orderBy('user_infos.surname')
                                            ->get();
        
        $moduleRegistrations = ModuleRegistration::where('academic_year_id', $moduleAllocation->academic_year_id)
                                            ->where('module_id', $moduleAllocation->module_id)
                                            ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
                                            ->where('campus_id', $moduleAllocation->campus_id)
                                            ->where('study_mode_id', $moduleAllocation->study_mode_id)
                                            ->join('user_infos', 'user_infos.id', '=', 'module_registrations.user_info_id')
                                            ->orderBy('user_infos.surname')
                                            ->get();

        $assessmentType = AssessmentType::find($assessmentTypeId);
        

        return view('pages.assessments.final_marks.report', compact('moduleAllocation', 'studentFinalMarks', 'assessmentTypeId', 'moduleRegistrations', 'assessmentType'));  

    }

    public function process(Request $request)
    {
        
        try {
            
            $studentCas = StudentCa::where('module_id', $request->module_id)
                                    ->where('academic_year_id', $request->academic_year_id)
                                    ->where('study_mode_id', $request->study_mode_id)
                                    ->where('academic_intake_id', $request->academic_intake_id)
                                    ->where('campus_id', $request->campus_id)
                                    ->get();

            //dd($studentCas->where('user_info_id', 3296));

            if (!count($studentCas)) {
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Processing of Final Marks failed. CA marks not found']);
            }

            $examAdmissionCriteria = ExamAdmissionCriteria::where('module_id', $request->module_id)
                                                        ->where('academic_year_id', $request->academic_year_id)
                                                        ->where('assessment_type_id', $request->assessment_type_id)
                                                        ->first();
            
            if (!$examAdmissionCriteria) {
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Processing of Final Marks failed. No Exam Admission Criteria defined for the selected module.']);
            }
            
            $caPassedStudents = $studentCas->where('ca_mark', '>=', $examAdmissionCriteria->minimum_ca_mark);
            
            $caFailedStudents = $studentCas->where('ca_mark', '<', $examAdmissionCriteria->minimum_ca_mark);
            
            if(count($caFailedStudents)){

                $this->processFailedCas($caFailedStudents, $request->assessment_type_id);
            }

            if(count($caPassedStudents)){

                $studentExamMarks = StudentExamination::where('module_id', $request->module_id)
                                                        ->where('academic_year_id', $request->academic_year_id)
                                                        ->where('study_mode_id', $request->study_mode_id)
                                                        ->where('academic_intake_id', $request->academic_intake_id)
                                                        ->where('assessment_type_id', $request->assessment_type_id)
                                                        ->where('campus_id', $request->campus_id)
                                                        ->get();
                
                if(!count($studentExamMarks)){
                    return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Processing of Final Marks failed. Exam marks not found']);
                }

                $this->computeExamMarks($studentExamMarks, $request, $caPassedStudents, $examAdmissionCriteria);
            }
            
            return redirect()->route('assessments.final_marks.report', [$request->module_allocation_id, $request->assessment_type_id])->withInput()
                ->with('success_message', 'Final Marks for successfully processed.');

        } catch (Exception $e) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Your Final Mark calculation criteria is NOT defined properly, please set it under Settings.']);
        }

    }

    private function computeExamMarks($studentExamMarks, $request, $caPassedStudents, $examAdmissionCriteria){
                
        // $examAdmissionCriteria = ExamAdmissionCriteria::where('module_id', $request->module_id)
        //                                         ->where('academic_year_id', $request->academic_year_id)
        //                                         ->first();


        $finalMarkCriterias = FinalMarkCriteria::where('module_id', $request->module_id)
                                        ->where('academic_year_id', $request->academic_year_id)
                                        ->where('assessment_type_id', $request->assessment_type_id)
                                        ->get();
        
        $resultCodes = AssessmentResultCode::all();

        $studentFinalMarks = StudentFinalMark::where('module_id', $request->module_id)
                                            ->where('academic_year_id', $request->academic_year_id)
                                            ->where('study_mode_id', $request->study_mode_id)
                                            ->where('academic_intake_id', $request->academic_intake_id)
                                            ->where('assessment_type_id', $request->assessment_type_id)
                                            ->where('campus_id', $request->campus_id)
                                            ->get();
        
        $assesmentType = AssessmentType::find($request->assessment_type_id);

        foreach ($studentExamMarks as $key => $examMark) {

            $caMark = $caPassedStudents->where('module_id', $request->module_id)
                                        ->where('academic_year_id', $request->academic_year_id)
                                        ->where('study_mode_id', $request->study_mode_id)
                                        ->where('academic_intake_id', $request->academic_intake_id)
                                        ->where('campus_id', $request->campus_id)
                                        ->where('user_info_id', $examMark->user_info_id)
                                        ->first();
            
            if($caMark){
                
                $finalResult = $this->calculateFinalMark($caMark, $examMark->exam_mark, $examAdmissionCriteria, $finalMarkCriterias, $assesmentType);

                $resultCode = $resultCodes->find($finalResult['assessment_result_code_id']);
                
                if($examMark->pass_fail == 'F'){
                    $studentFinalMark = $studentFinalMarks->where('user_info_id', $examMark->user_info_id)->first();

                    if ($studentFinalMark) {
                        $studentFinalMark->final_mark = round($finalResult['final_mark']);
                        $studentFinalMark->grading_scale_id = $examMark->assessment_result_code_id;
                        $studentFinalMark->pass_fail = $examMark->pass_fail;
                        $studentFinalMark->updated_by = auth()->user()->id;
                        $studentFinalMark->save();
                    } else {

                        StudentFinalMark::create([
                            'user_info_id' => $examMark->user_info_id,
                            'module_id' => $examMark->module_id,
                            'academic_year_id' => $examMark->academic_year_id,
                            'study_mode_id' => $examMark->study_mode_id,
                            'academic_intake_id' => $examMark->academic_intake_id,
                            'campus_id' => $examMark->campus_id,
                            'assessment_type_id' => $examMark->assessment_type_id,
                            'final_mark' => round($finalResult['final_mark']),
                            'grading_scale_id' => $examMark->assessment_result_code_id,
                            'pass_fail' => $resultCode->pass_fail,
                            'created_by' => auth()->user()->id
                        ]);  
                    }       
                } else {
                    
                    $studentFinalMark = $studentFinalMarks->where('user_info_id', $examMark->user_info_id)->first();
                    
                    if($studentFinalMark){
                        $studentFinalMark->final_mark = round($finalResult['final_mark']);
                        $studentFinalMark->grading_scale_id = $finalResult['assessment_result_code_id'];
                        $studentFinalMark->pass_fail = $resultCode->pass_fail;
                        $studentFinalMark->updated_by = auth()->user()->id;
                        $studentFinalMark->save();
                    } else {
                        StudentFinalMark::create([
                            'user_info_id' => $examMark->user_info_id,
                            'module_id' => $examMark->module_id,
                            'academic_year_id' => $examMark->academic_year_id,
                            'study_mode_id' => $examMark->study_mode_id,
                            'academic_intake_id' => $examMark->academic_intake_id,
                            'campus_id' => $examMark->campus_id,
                            'assessment_type_id' => $examMark->assessment_type_id,
                            'final_mark' => round($finalResult['final_mark']),
                            'grading_scale_id' => $finalResult['assessment_result_code_id'],
                            'pass_fail' => $resultCode->pass_fail,
                            'created_by' => auth()->user()->id
                        ]);         
                    }
                }
            }
        }
    }

    private function calculateFinalMark($caMark, $examMark, $criteria, $gradingScale, $assesmentType)
    {
        $ca = $caMark->ca_mark * $criteria->ca_weight / 100;
        
        $exam = $examMark * $criteria->exam_weight / 100;
        
        $finalMark = $ca + $exam;
        
        $resultCode = $gradingScale->where('max_mark', '>=', $finalMark)->first();
        
        $finalMark = ($finalMark > $assesmentType->maximum_mark) ? $assesmentType->maximum_mark : $finalMark;

        return [
            'final_mark' => $finalMark,
            'assessment_result_code_id' => $resultCode->assessment_result_code_id
        ];
        
    }

    private function processFailedCas($caFailedStudents, $assessmentTypeId){

        $examAdmissionCriteria = ExamAdmissionCriteria::where('module_id', $caFailedStudents->first()->module_id)
                                                      ->where('academic_year_id', $caFailedStudents->first()->academic_year_id)
                                                      ->first();

        StudentFinalMark::whereIn('user_info_id', $caFailedStudents->pluck('user_info_id'))
                        ->where('module_id', $caFailedStudents->first()->module_id)
                        ->where('academic_year_id', $caFailedStudents->first()->academic_year_id)
                        ->where('study_mode_id', $caFailedStudents->first()->study_mode_id)
                        ->where('academic_intake_id', $caFailedStudents->first()->academic_intake_id)
                        ->where('campus_id', $caFailedStudents->first()->campus_id)
                        ->where('assessment_type_id', $assessmentTypeId)
                        ->delete();

        foreach($caFailedStudents as $failedStudent){

            StudentFinalMark::create([
                'user_info_id' => $failedStudent->user_info_id, 
                'module_id' => $failedStudent->module_id, 
                'academic_year_id' => $failedStudent->academic_year_id, 
                'study_mode_id' => $failedStudent->study_mode_id, 
                'academic_intake_id' => $failedStudent->academic_intake_id, 
                'campus_id' => $failedStudent->campus_id, 
                'assessment_type_id' => $assessmentTypeId, 
                'final_mark' => 0, 
                'grading_scale_id' => $examAdmissionCriteria->assessment_result_code_id,
                'pass_fail' => 'F',
                'created_by' => auth()->user()->id
            ]);
        }
    }
    

    public function downloadExamReport($moduleAllocationId, $assessmentTypeId)
    {
        $moduleAllocation = ModuleAllocation::find($moduleAllocationId);
        session()->put('moduleAllocation', $moduleAllocation);

        $studentFinalMarks = StudentFinalMark::with('assessmentResultCode', 'continuousAssessment', 'examinationMark')
                                            ->where('academic_year_id', $moduleAllocation->academic_year_id)
                                            ->where('module_id', $moduleAllocation->module_id)
                                            ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
                                            ->where('assessment_type_id', $assessmentTypeId)
                                            ->where('campus_id', $moduleAllocation->campus_id)
                                            ->where('study_mode_id', $moduleAllocation->study_mode_id)
                                            ->join('user_infos', 'user_infos.id', '=', 'student_final_marks.user_info_id')
                                            ->orderBy('user_infos.surname')
                                            ->get();

                                           
        session()->put('studentFinalMarks', $studentFinalMarks);

        $moduleRegistrations = ModuleRegistration::where('academic_year_id', $moduleAllocation->academic_year_id)
            ->where('module_id', $moduleAllocation->module_id)
            ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
            ->where('assessment_type_id', $assessmentTypeId)
            ->where('campus_id', $moduleAllocation->campus_id)
            ->where('study_mode_id', $moduleAllocation->study_mode_id)
            ->join('user_infos', 'user_infos.id', '=', 'module_registrations.user_info_id')
            ->orderBy('user_infos.surname')
            ->get();
        session()->put('moduleRegistrations', $moduleRegistrations);

        $assessmentType = AssessmentType::find($assessmentTypeId);
        session()->put('assessmentType', $assessmentType);

        $filename = $moduleAllocation->module->module_name . "final_marks_report";

        return Excel::download(new FinalMarksReport, $filename . '' . '.xlsx');
        
    }
}
