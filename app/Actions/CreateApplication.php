<?php

namespace App\Actions;

use App\Models\UserInfoApplication;

class CreateApplication
{
    public function create($data, $user_info)
    {
        if($user_info->application){

            $user_info->application->update($data);

        } else {

            UserInfoApplication::create(array_merge($data, ['user_info_id' =>  $user_info->id]));

        }
        
    }
}
