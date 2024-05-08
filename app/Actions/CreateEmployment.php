<?php

namespace App\Actions;

use App\Models\UserInfoEmployment;

class CreateEmployment
{
    public function create($request, $user_info)
    {
        $data = $request->validate([
            'position' => 'nullable',
            'department' => 'nullable',
            'company_name' => 'nullable',
            'company_address' => 'nullable',
            'work_contact_number' => 'nullable',
            'work_email' => 'nullable',
        ]);

        if($user_info->employment){
            if(isset($data['company_name'])){
                $user_info->employment->update([
                    'position' => $data['position'],
                    'department' => $data['department'],
                    'company_name' => $data['company_name'],
                    'company_address' => $data['company_address'],
                    'work_contact_number' => $data['work_contact_number'],
                    'work_email' => $data['work_email']
                ]);
            }
        } else {
            if (isset($data['company_name'])) {
                UserInfoEmployment::create([
                    'user_info_id' =>  $user_info->id,
                    'position' => $data['position'],
                    'department' => $data['department'],
                    'company_name' => $data['company_name'],
                    'company_address' => $data['company_address'],
                    'work_contact_number' => $data['work_contact_number'],
                    'work_email' => $data['work_email']
                ]);
            }
        }
    }
}
