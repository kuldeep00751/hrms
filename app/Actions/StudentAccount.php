<?php

namespace App\Actions;

use App\Models\AcademicStructure;
use App\Models\AcademicYear;
use App\Models\ModuleCancellationPolicy;
use App\Models\StudentAccount as Account;

class StudentAccount
{
    public function chargeExtraFees($fees, $id){
        
        foreach($fees as $fee){
            Account::create([
                'user_info_id' => $id, 
                'financial_year_id'=> $fee->academic_year_id, 
                'reference' => "Register", 
                'transaction_date' => date('Y-m-d'), 
                'transaction_description' => $fee->feeType->fee_type_name,
                'transaction_type' => 'OtherFee',
                'model_type' => 'OtherFee',
                'model_id' => $fee->id,
                'debit' => $fee->amount, 
                'credit' => 0
            ]);
        }
    }

    public function chargeCourseFee($courseFee, $id)
    {
        Account::create([
            'user_info_id' => $id,
            'financial_year_id' => $courseFee->academic_year_id,
            'reference' => "Register",
            'transaction_date' => date('Y-m-d'),
            'transaction_description' => $courseFee->qualification->qualification_name,
            'transaction_type' => 'QualificationRegistration',
            'model_type' => 'Qualification',
            'model_id' => $courseFee->qualification->id,
            'debit' => $courseFee->amount,
            'credit' => 0
        ]);
    }

    public function chargeModuleFees($moduleFees, $id)
    {
        
        foreach ($moduleFees as $fee) {
            Account::create([
                'user_info_id' => $id,
                'financial_year_id' => $fee->academic_year_id,
                'reference' => "Register",
                'transaction_date' => date('Y-m-d'),
                'transaction_description' => $fee->module->module_name,
                'transaction_type' => 'ModuleRegistration',
                'model_type' => 'Module',
                'model_id' =>  $fee->module->id,
                'debit' => $fee->amount,
                'credit' => 0
            ]);
        }
    }

    public function creditStudentPayment($payment){
        
        $payment_description = "";

        if(isset($payment->pop_reference)){
            $payment_description = $payment->payment_description." - ". $payment->pop_reference;
        } else {
            $payment_description = $payment->payment_description;
        }

        Account::create([
            'user_info_id' => $payment->user_info_id,
            'financial_year_id' => $this->getFinancialYearId(date('Y')),
            'reference' => $payment->payment_reference,
            'transaction_date' => $payment->payment_date,
            'transaction_description' =>  $payment_description,
            'transaction_type' => 'Payment',
            'model_type' => 'Payment',
            'model_id' =>  $payment->id,
            'debit' => 0,
            'credit' => $payment->payment_amount
        ]);
    }

    private function getFinancialYearId($year){
        return AcademicYear::where('name', $year)->first()->id;
    }

    public function creditStudentCancellationModule($moduleRegistration, $cancellationPercentage, $moduleFee, $action){
        
        Account::create([
            'user_info_id' => $moduleRegistration->user_info_id,
            'financial_year_id' => $moduleRegistration->academic_year_id,
            'reference' => $action,
            'transaction_date' => date('Y-m-d'),
            'transaction_description' =>  $moduleRegistration->module->module_name." (". $action .")",
            'transaction_type' => 'Cancellation',
            'model_type' => 'Module',
            'model_id' =>  $moduleRegistration->module->id,
            'debit' => 0,
            'credit' => $this->calculateCancellationFee($cancellationPercentage, $moduleFee),
        ]);
    }

    public function creditStudentCancellationQualification($qualificationRegistration, $cancellationPercentage, $qualificationFee){
        Account::create([
            'user_info_id' => $qualificationRegistration->user_info_id,
            'financial_year_id' => $qualificationRegistration->academic_year_id,
            'reference' => 'Cancel',
            'transaction_date' => date('Y-m-d'),
            'transaction_description' =>  'Cancel ' . $qualificationRegistration->qualification->qualification_name,
            'transaction_type' => 'Cancellation',
            'model_type' => 'Qualification',
            'model_id' =>  $qualificationRegistration->qualification->id,
            'debit' => 0,
            'credit' => $this->calculateCancellationFee($cancellationPercentage, $qualificationFee),
        ]);
    }

    private function calculateCancellationFee($cancellationPercentage, $fee){
        
        return $fee->amount * $cancellationPercentage / 100;

    }

}
