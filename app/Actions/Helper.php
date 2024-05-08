<?php

namespace App\Actions;

use App\Models\AcademicProcess;
use App\Models\Lov;
use App\Models\Registration;

class Helper
{
    public function getListOfValue($label)
    {
        return Lov::where('label', $label)->first()->value;
    }

    public function getApplicationAcademicProcess(){
        $applicationAcademicProcesses = AcademicProcess::with('academicYear', 'academicIntake')
                                            ->where('start_date','<=', date('Y-m-d'))
                                            ->where('end_date', '>=', date('Y-m-d'))
                                            ->where('process_name', 'Application')
                                            ->get();

        return $applicationAcademicProcesses;

    }

    public function isAdmissionProcessOpen($academicYearid, $academicIntakeId){
        $admissionProcess = AcademicProcess::where('start_date', '<=', date('Y-m-d'))
                                            ->where('end_date', '>=', date('Y-m-d'))
                                            ->where('process_name', 'Admission')
                                            ->where('academic_year_id', $academicYearid)
                                            ->where('academic_intake_id', $academicIntakeId)
                                            ->get();

        if(count($admissionProcess) > 0){
            return true;
        } else {
            return false;
        }
    }

    public function processFinalMarksAcademicProcess($academicYearid)
    {
        $processFinalMark = AcademicProcess::where('start_date', '<=', date('Y-m-d'))
                            ->where('end_date', '>=', date('Y-m-d'))
                            ->where('process_name', 'Process Final Marks')
                            ->where('academic_year_id', $academicYearid)
                            ->get();

       return $processFinalMark;
    }

    public function isRegistrationProcessOpen($academicYearid, $academicIntakeId){
        $registrationProcess = AcademicProcess::where('start_date', '<=', date('Y-m-d'))
                                            ->where('end_date', '>=', date('Y-m-d'))
                                            ->where('process_name', 'Registration')
                                            ->where('academic_year_id', $academicYearid)
                                            ->where('academic_intake_id', $academicIntakeId)
                                            ->get();
        
        if(count($registrationProcess) > 0){
            return true;
        } else {
            return false;
        }
    }

    public function isCancellationProcessOpen($academicYearid, $academicIntakeId)
    {
        $cancellationProcess = AcademicProcess::where('start_date', '<=', date('Y-m-d'))
                                                ->where('end_date', '>=', date('Y-m-d'))
                                                ->where('process_name', 'Cancellations')
                                                ->where('academic_year_id', $academicYearid)
                                                ->where('academic_intake_id', $academicIntakeId)
                                                ->get();
        
        if (count($cancellationProcess) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function isCreateAccountOpen()
    {
        $accountCreationProcess = AcademicProcess::where('start_date', '<=', date('Y-m-d'))
        ->where('end_date', '>=', date('Y-m-d'))
        ->where('process_name', 'Create Student Account')
            ->get();

        if (count($accountCreationProcess) > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function isExemptionProcessOpen($academicYearid, $academicIntakeId)
    {
        $exemptionProcess = AcademicProcess::where('start_date', '<=', date('Y-m-d'))
                                                ->where('end_date', '>=', date('Y-m-d'))
                                                ->where('process_name', 'Exemptions')
                                                ->where('academic_year_id', $academicYearid)
                                                ->where('academic_intake_id', $academicIntakeId)
                                                ->get();

        if (count($exemptionProcess) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getYearLevel($application)
    {
        $registration = Registration::where('qualification_id', $application->qualification_id)
            ->orderBy('id', 'desc')
            ->get();

        if (!count($registration)) {
            return 1;
        }
        
        $promotion_status = $registration->first()->promotion_status;
        
        if ($promotion_status == 0 ) {
            
            $data = $registration->first()->year_level_id;
            
            return $data;
        }

        if ($promotion_status == 1) {
            $yearLevel = $registration->first()->year_level_id;

            return $yearLevel + 1;
        }
    }

    public function getStudentTypeId($userInfo){
        if($userInfo->citizenship_status == "Namibian") {
            return 1;
        } else {
            return 2;
        }
    }
}
