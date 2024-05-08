<?php

namespace App\Actions;

use App\Models\CourseFee;
use App\Models\OtherFee;
use App\Models\SubjectFee;

class CopyFees
{
   public function copy($request, $feeType){
        switch ($feeType) {
            case 'Subject Fees':
                $this->copySubjectFees($request);
                break;
            case 'Course Fees':
                $this->copyCourseFees($request);
                break;
            case 'Other Fees':
                $this->copyOtherFees($request);
                break;
        }
   }

   public function copySubjectFees($request){
        $fromFees = SubjectFee::where('academic_year_id', $request->from_year)->get();

        foreach($fromFees as $fromFee){
            SubjectFee::create([
                'module_id'         => $fromFee->module_id,
                'academic_year_id'  => $request->to_year,
                'created_by'        => $request->created_by,
                'amount'            => $this->getNewFeeAmount($request, $fromFee->amount),
                'student_type_id'   => $fromFee->student_type_id,
                'assessment_type_id'=> $fromFee->assessment_type_id,
                'academic_process'  => $fromFee->academic_process,
            ]);
        }
   }

    public function copyCourseFees($request)
    {
        $fromFees = CourseFee::where('academic_year_id', $request->from_year)->get();

        foreach ($fromFees as $fromFee) {
            CourseFee::create([
                'qualification_id'  => $fromFee->qualification_id,
                'academic_year_id'  => $request->to_year,
                'created_by'        => $request->created_by,
                'amount'            => $this->getNewFeeAmount($request, $fromFee->amount),
                'student_type_id'   => $fromFee->student_type_id,
                'academic_process'  => $fromFee->academic_process,
            ]);
        }
    }

    public function copyOtherFees($request)
    {
        $fromFees = OtherFee::where('academic_year_id', $request->from_year)->get();
        
        foreach ($fromFees as $fromFee) {
            OtherFee::create([
                'fee_type_id'       => $fromFee->fee_type_id,
                'academic_year_id'  => $request->to_year,
                'created_by'        => $request->created_by,
                'amount'            => $this->getNewFeeAmount($request, $fromFee->amount),
                'student_type_id'   => $fromFee->student_type_id,
                'academic_process'  => $fromFee->academic_process,
            ]);
        }
    }

   public function getNewFeeAmount($request, $amount){
        
        switch ($request->increase_type) {
            case 'percentage':

                if ($request->increase_percentage > 0) {
                    return ($amount * $request->increase_percentage) + $amount;
                } else {
                    return $amount;
                }

                break;
            case 'fixed':
                
                if ($request->increase_by > 0) {
                    return $amount + $request->increase_by;
                } else {
                    return $amount;
                }

                break;
        }
   }
}
