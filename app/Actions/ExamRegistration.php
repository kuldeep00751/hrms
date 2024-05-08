<?php

namespace App\Actions;

use App\Models\ExamModulePaper;
use App\Models\ExamPaper;
use App\Models\ExamRegistrationCriteria;
use App\Models\ModuleRegistration;
use App\Models\StudentAccount;
use App\Models\StudentExamination;
use App\Models\StudentFinalMark;
use App\Models\SubjectFee;
use App\Models\UserInfo;
use App\Models\UserInfoSchoolSubjects;
use Exception;

class ExamRegistration
{
    public function registerExam($request, $assessmentMarkType){
        
        try {
            $examRegistrationCriteria = ExamRegistrationCriteria::where('required_assessment_exam_id', $request->assessment_type_id)
                ->where('required_assessment_mark', $assessmentMarkType)
                ->first();

                if (!$examRegistrationCriteria) {
                    return [
                        'status' => 0,
                        'message' => "Exam Registration failed. Exam registration criteria not found."
                    ];
                }
                
                
            $examPapers = ExamPaper::select('id')
                ->where('module_id', $request->module_id)
                ->where('academic_year_id', $request->academic_year_id)
                ->where('assessment_type_id', $examRegistrationCriteria->assessment_type_id)
                ->get();
            
            if (!count($examPapers)) {
                return [
                    'status' => 0,
                    'message' => "Exam Registration failed. Please define exam papers in control panel."
                ];
            }
            
            
            $examModulePapers = ExamModulePaper::where('module_id', $request->module_id)
                                                ->where('academic_year_id', $request->academic_year_id)
                                                ->where('study_mode_id', $request->study_mode_id)
                                                ->where('academic_intake_id', $request->academic_intake_id)
                                                ->where('campus_id', $request->campus_id)
                                                ->get();


            $studentExaminations = StudentExamination::where('module_id', $request->module_id)
                                                        ->where('academic_year_id', $request->academic_year_id)
                                                        ->where('study_mode_id', $request->study_mode_id)
                                                        ->where('academic_intake_id', $request->academic_intake_id)
                                                        ->where('campus_id', $request->campus_id)
                                                        ->get();

            $studentFinalMarks = StudentFinalMark::where('module_id', $request->module_id)
                                                    ->where('academic_year_id', $request->academic_year_id)
                                                    ->where('study_mode_id', $request->study_mode_id)
                                                    ->where('academic_intake_id', $request->academic_intake_id)
                                                    ->where('campus_id', $request->campus_id)
                                                    ->get();

            $moduleRegistrations = ModuleRegistration::where('academic_year_id', $request->academic_year_id)
                                                    ->where('is_exempted', 0)
                                                    ->where('is_cancelled', 0)
                                                    ->where('academic_intake_id', $request->academic_intake_id)
                                                    ->where('study_mode_id', $request->study_mode_id)
                                                    ->where('module_id', $request->module_id)
                                                    ->where('campus_id', $request->campus_id)
                                                    ->get();

            $userInfos = UserInfo::whereIn('id', $moduleRegistrations->pluck('id'))->get();
            
            foreach ($moduleRegistrations as $moduleRegistration) {
                
                $studentExamination = $studentExaminations->where('user_info_id', $moduleRegistration->user_info_id)
                                                        ->where('assessment_type_id', $request->assessment_type_id)
                                                        ->first();
                
                $meetsExamCriteria = $this->meetsExamRegistrationCriteria($examRegistrationCriteria, $studentExamination);
                
                if ($meetsExamCriteria) {
            
                    foreach ($examPapers as $examPaper) {

                        $examModulePaper = $examModulePapers->where('user_info_id', $moduleRegistration->user_info_id)
                            ->where('exam_paper_id', $examPaper->id)
                            ->where('assessment_type_id', $examRegistrationCriteria->assessment_type_id)
                            ->first();

                        if (!$examModulePaper) {
                            ExamModulePaper::create([
                                'user_info_id' => $moduleRegistration->user_info_id,
                                'module_id' => $request->module_id,
                                'academic_year_id' => $request->academic_year_id,
                                'study_mode_id' => $request->study_mode_id,
                                'academic_intake_id' => $request->academic_intake_id,
                                'assessment_type_id' => $examRegistrationCriteria->assessment_type_id,
                                'campus_id' => $request->campus_id,
                                'exam_paper_id' => $examPaper->id,
                                'mark' => 0,
                                'pass_fail' => "F",
                                'created_by' => auth()->user()->id,
                            ]);
                        }
                    }
                    

                    $studentExamination = $studentExaminations->where('user_info_id', $moduleRegistration->user_info_id)
                        ->where('assessment_type_id', $examRegistrationCriteria->assessment_type_id)
                        ->first();

                    
                    if (!$studentExamination) {
                        
                        StudentExamination::create([
                            'user_info_id' => $moduleRegistration->user_info_id,
                            'module_id' => $request->module_id,
                            'academic_year_id' => $request->academic_year_id,
                            'study_mode_id' => $request->study_mode_id,
                            'academic_intake_id' => $request->academic_intake_id,
                            'assessment_type_id' => $examRegistrationCriteria->assessment_type_id,
                            'campus_id' => $request->campus_id,
                            'exam_mark' => 0,
                            'pass_fail' => "F",
                            'created_by' => auth()->user()->id,
                        ]);

                        $userInfo = $userInfos->find($moduleRegistration->user_info_id);

                        $moduleFees = $this->getModuleFee($request->academic_year_id, $examRegistrationCriteria->assessment_type_id, $userInfo->citizenship_status, $request->module_id);

                        $this->chargeExamModuleFees($moduleFees, $moduleRegistration->user_info_id);

                    }
                }
            }

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
        
    }

    private function meetsExamRegistrationCriteria($examRegistrationCriteria, $studentExamination){

        if(($studentExamination->exam_mark >= $examRegistrationCriteria->minimum_mark) && ($studentExamination->exam_mark <= $examRegistrationCriteria->maximum_mark))
        {
            return true;
        }

        return false;
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

    private function getModuleFee($academicYearId, $assessmentTypeId, $studentTypeId, $moduleId)
    {
        return SubjectFee::with('module')
        ->where('academic_year_id', $academicYearId)
            ->where('assessment_type_id', $assessmentTypeId)
            ->where('student_type_id', $studentTypeId)
            ->where('module_id', $moduleId)
            ->get();
    }
   
}
