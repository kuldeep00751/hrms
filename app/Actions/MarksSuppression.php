<?php
namespace App\Actions;

use App\Models\AssessmentSuppression;

class MarksSuppression
{
    public function isSuppressed($data, $suppressionType){
        
        $assessmentSuppression = AssessmentSuppression::where('academic_year_id', $data->academic_year_id)
                                                        ->where('academic_intake_id', $data->academic_intake_id)
                                                        ->where('campus_id', $data->campus_id)
                                                        ->where('study_mode_id', $data->study_mode_id)
                                                        ->where('suppression_type', $suppressionType)
                                                        ->first();
        
        if(!$assessmentSuppression){
            return true;  
        } else {
            if($assessmentSuppression->suppress_yn == 1){
                return true;
            } else {
                return false;
            }
        }
    }
}