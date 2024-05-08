<?php

namespace App\Actions;

use App\Models\CaMarkTypes;
use App\Models\ContinuousAssessmentWeight;
use App\Models\StudentCa;

class ProcessCaMarks
{
    public function process($request)
    {
        
        $marks = CaMarkTypes::where('module_id', $request->module_id)
                            ->where('academic_year_id', $request->academic_year_id)
                            ->where('academic_intake_id', $request->academic_intake_id)
                            ->where('study_mode_id', $request->study_mode_id)
                            ->where('campus_id', $request->campus_id)
                            ->get();
        
        $markTypeIds = $marks->pluck('mark_type_id', 'mark_type_id');
        
        $cas = StudentCa::where('module_id', $marks->first()->module_id)
                        ->where('academic_year_id', $marks->first()->academic_year_id)
                        ->where('academic_intake_id', $marks->first()->academic_intake_id)
                        ->where('study_mode_id', $marks->first()->study_mode_id)
                        ->where('campus_id', $marks->first()->campus_id)
                        ->get();

        $weights = ContinuousAssessmentWeight::whereIn('id', $markTypeIds)->get();
        
        $userInfoIds = $marks->pluck('user_info_id')->unique();

        foreach ($userInfoIds as $userInfoId) {
            $studentMark = $cas->where('user_info_id', $userInfoId)->first();

            $studentMarks = $marks->where('user_info_id', $userInfoId);
            

            if ($studentMark) {
                $studentMark->ca_mark = round($this->calculateStudentCa($weights, $studentMarks));
                $studentMark->updated_by = auth()->user()->id;
                $studentMark->save();
            } else {
                StudentCa::create([
                    'user_info_id' => $studentMarks->first()->user_info_id,
                    'module_id' => $studentMarks->first()->module_id,
                    'academic_year_id' => $studentMarks->first()->academic_year_id,
                    'academic_intake_id' => $studentMarks->first()->academic_intake_id,
                    'study_mode_id' => $studentMarks->first()->study_mode_id,
                    'campus_id' => $studentMarks->first()->campus_id,
                    'mark_type_id' => $studentMarks->first()->mark_type_id,
                    'ca_mark' => round($this->calculateStudentCa($weights, $studentMarks)),
                    'created_by' => auth()->user()->id
                ]);
            }
        }
    }

    private function calculateStudentCa($weights, $marks){
        $ca = 0;
        
        foreach ($marks as $mark) {
            
            $weight = $weights->find($mark->mark_type_id)->weight;
            
            $ca += $mark->mark * $weight / 100;
            
        }
        
        return $ca;
    }
}
