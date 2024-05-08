<?php

namespace App\Actions;

use App\Models\Registration;
use App\Models\StudentBlockException;
use App\Models\StudentOtherBlock;

class StudentBlocks
{
    public function isStudentBlocked(StudentBalance $studentBalance){
        $studentBlocks = $this->getStudentBlocks();

        $blocked = false;

        $isInException = $this->isStudentInException();

        if($isInException){
            return $blocked;
        }

        $financialBlock = $studentBlocks->where('block_type', 'FinancialBlock')->first();
        
        if($financialBlock){
            $financialBlockStatus = $this->isBlockedByFinancialReasons($studentBalance, $financialBlock);
            
            if($financialBlockStatus){
                $blocked = true;
            }
        }

        $qualificationBlock = $studentBlocks->where('block_type', 'QualificationBlock')->first();

        if ($qualificationBlock) {
            $qualificationBlockStatus = $this->isBlockedByQualification($qualificationBlock);

            if ($qualificationBlockStatus) {
                $blocked = true;
            }
        }

        return $blocked;
    }

    private function isBlockedByFinancialReasons($studentBalance, $financialBlock){
        $userInfoId = auth()->user()->info->id;

        $studentBalance = $studentBalance->getStudentBalance($userInfoId);

        $financialBlockAmount = $financialBlock->value;
        
        if($studentBalance > $financialBlockAmount ){
            return true;
        }

        return false;
    }

    private function isBlockedByQualification($qualificationBlock){
        $userInfoId = auth()->user()->info->id;

        $studentQualifications = $this->getStudentRegistrations($userInfoId);

        $qualificationBlockIds = json_decode($qualificationBlock->value);

        foreach($studentQualifications as $key => $value){
            
            if(in_array($value->qualification_id, $qualificationBlockIds)){
                return true;
            }
        }

        return false;
    }

    private function getStudentRegistrations($userInfoId){
        $registrations = Registration::where('user_info_id', $userInfoId)->get();

        if(count($registrations)){
            return $registrations;
        }

        return null;
    }
    
    private function isStudentInException(){
        $userInfoId = auth()->user()->info->id;

        $blockException = StudentBlockException::where('user_info_id', $userInfoId)->first();

        if($blockException){
            return true;
        }

        return false;
    }

    private function getStudentBlocks(){
        return StudentOtherBlock::all();
    }
}