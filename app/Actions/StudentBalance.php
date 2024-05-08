<?php

namespace App\Actions;

use App\Models\StudentAccount;
use App\Models\UserInfo;

class StudentBalance
{

    public function getStudentBalance($userInfoId){

        $studentAccount = StudentAccount::selectRaw('sum(debit) as debit, sum(credit) as credit')
                                        ->where('user_info_id', $userInfoId)
                                        ->groupBy('user_info_id')
                                        ->first();
        
                                        
        if($studentAccount){
            return $studentAccount->debit - $studentAccount->credit;
        }

        return 0;
        
    }
}