<?php

namespace App\Actions;

use App\Models\UserInfoSchoolSubjects;

class CreateSchoolLeavingSubjects
{
    public function create($data, $user_info)
    {
        
        $user_info->schoolSubjects()->delete();

        for ($i = 0; $i < count($data['school_subject_id']); $i++) {
            UserInfoSchoolSubjects::create([
                'school_subject_id' => $data['school_subject_id'][$i],
                'matric_type' => $data['matric_type'][$i],
                // 'mid_term_result' => $data['mid_term_result'][$i],
                // 'mid_term_points' => $data['mid_term_points'][$i],
                'final_term_result' => $data['final_term_result'][$i],
                'final_term_points' => $data['final_term_points'][$i],
                'user_info_id' =>  $user_info->id
            ]);
        }
    }
}
