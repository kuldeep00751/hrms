<?php

namespace App\Actions;

use App\Models\HealthQuestionnaire;

class CreateHealthQuestionnaire
{
    public function create($request, $user_info)
    {
        $data = $request->validate([
            'chronic_illness_yn' => 'required',
            'chronic_illness_description' => 'nullable',
            'disability_yn' => 'required',
            'disability_description' => 'nullable',
        ]);

        if($user_info->healthQuestionnaire){
            $user_info->healthQuestionnaire->update(
                [
                    'chronic_illness_yn' => $data['chronic_illness_yn'],
                    'chronic_illness_description' => $data['chronic_illness_description'],
                    'disability_yn' => $data['disability_yn'],
                    'disability_description' => $data['disability_description']
                ]
            );
        } else {
            HealthQuestionnaire::create([
                'user_info_id' =>  $user_info->id,
                'chronic_illness_yn' => $data['chronic_illness_yn'],
                'chronic_illness_description' => $data['chronic_illness_description'],
                'disability_yn' => $data['disability_yn'],
                'disability_description' => $data['disability_description']
            ]);
        }
    }
}
