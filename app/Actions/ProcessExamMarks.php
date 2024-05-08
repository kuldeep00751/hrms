<?php

namespace App\Actions;

use App\Models\AssessmentResultCode;
use App\Models\ExamAdmissionCriteria;
use App\Models\ExamMarkCriteria;
use App\Models\ExamModulePaper;
use App\Models\ExamPaper;
use App\Models\StudentCa;
use App\Models\StudentExamination;

class ProcessExamMarks
{
    public function process($request)
    {
        $paperMarks = $this->getExamModulePapers($request);
        
        $paperIds = $paperMarks->pluck('exam_paper_id', 'exam_paper_id');

        $studentExaminations = $this->getStudentEximations($paperMarks);

        $weights = ExamPaper::whereIn('id', $paperIds)->get();

        $examAdmissionCriteria = ExamAdmissionCriteria::where('module_id', $request->module_id)
                                                        ->where('assessment_type_id', $request->assessment_type_id)
                                                        ->where('academic_year_id', $request->academic_year_id)
                                                        ->first();

        $examMarkCriteria = ExamMarkCriteria::where('module_id', $request->module_id)
                                            ->where('assessment_type_id', $request->assessment_type_id)
                                            ->where('academic_year_id', $request->academic_year_id)
                                            ->get();

        $assessmentResultCodes = AssessmentResultCode::select('id', 'result_code', 'pass_fail')->get();
        
        foreach ($paperMarks as $key => $mark) {
            $studentMark = $studentExaminations->where('user_info_id', $mark->user_info_id)->first();

            $studentMarks = $paperMarks->where('user_info_id', $mark->user_info_id);
            
            $examPaperResult = $this->calculatePaperResult($weights, $studentMarks, $examAdmissionCriteria, $examMarkCriteria, $assessmentResultCodes);

            if ($studentMark) {
                $studentMark->exam_mark = round($examPaperResult['exam_mark']);
                $studentMark->updated_by = auth()->user()->id;
                $studentMark->pass_fail = $examPaperResult['pass_fail'];
                $studentMark->assessment_result_code_id = $examPaperResult['assessment_result_code'];
                $studentMark->save();
            } else {
                StudentExamination::create([
                    'user_info_id' => $mark->user_info_id,
                    'module_id' => $mark->module_id,
                    'academic_year_id' => $mark->academic_year_id,
                    'assessment_type_id' => $mark->assessment_type_id,
                    'academic_intake_id' => $mark->academic_intake_id,
                    'study_mode_id' => $mark->study_mode_id,
                    'campus_id' => $mark->campus_id,
                    'exam_mark' => round($examPaperResult['exam_mark']),
                    'pass_fail' => $examPaperResult['pass_fail'],
                    'assessment_result_code_id' => $examPaperResult['assessment_result_code'],
                    'created_by' => auth()->user()->id
                ]);
            }
        }

    }

    private function getExamModulePapers($request){
        return ExamModulePaper::where('module_id', $request->module_id)
                            ->where('academic_year_id', $request->academic_year_id)
                            ->where('academic_intake_id', $request->academic_intake_id)
                            ->where('assessment_type_id', $request->assessment_type_id)
                            ->where('study_mode_id', $request->study_mode_id)
                            ->where('campus_id', $request->campus_id)
                            ->get();
    }

    private function getStudentEximations($paperMarks){

        return StudentExamination::where('module_id', $paperMarks->first()->module_id)
            ->where('academic_year_id', $paperMarks->first()->academic_year_id)
            ->where('assessment_type_id', $paperMarks->first()->assessment_type_id)
            ->where('academic_intake_id', $paperMarks->first()->academic_intake_id)
            ->where('study_mode_id', $paperMarks->first()->study_mode_id)
            ->where('campus_id', $paperMarks->first()->campus_id)
            ->get();
        
    }

    public function calculatePaperResult($criterias, $paperMarks, $examAdmissionCriteria, $examMarkCriteria, $assessmentResultCodes){
        $exam_mark = 0;
        $pass_fail = 'P';
        $resultCodeId = 0;
        
        foreach ($paperMarks as $mark) {

            $criteria = $criterias->find($mark->exam_paper_id);

            $weight = $criteria->weight;
            
            $exam_mark += $mark->mark * $weight / 100;

            $minimumMark = $criteria->minimum_pass_mark;

            if($mark->mark < $minimumMark){
                $pass_fail = 'F';
                $resultCodeId = $criteria->assessment_result_code_id;
            }
            
            if ($mark->mark === $examAdmissionCriteria->absent_exam_indicator) {
                $pass_fail = 'F';
                $resultCodeId = $examAdmissionCriteria->absent_exam_result_code;
            }
            
        }

        //if the paper is passed, then we need to calculate exam results based on exam marks
        if($pass_fail === 'P'){
            $examResults = $this->calculateExamMarkResults($exam_mark, $examMarkCriteria, $assessmentResultCodes);

            return [
                'exam_mark' => $exam_mark,
                'pass_fail' => $examResults['pass_fail'],
                'assessment_result_code' => $examResults['assessment_result_code'],
            ];
        }
        
        
        return [
            'exam_mark' => $exam_mark,
            'pass_fail' => $pass_fail,
            'assessment_result_code' => $resultCodeId,
        ];
    }

    public function calculateExamMarkResults($examMark, $examMarkCriterias, $assessmentResultCodes){

        $examResult =  $examMarkCriterias->where('max_mark', '>=', $examMark)->first();

        $resulCode = $assessmentResultCodes->where('id', $examResult->assessment_result_code_id)->first();

        return [
            'pass_fail' => $resulCode->pass_fail,
            'assessment_result_code' => $examResult->assessment_result_code_id,
        ];

    }
}
