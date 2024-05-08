<?php

namespace App\Actions;

use App\Mail\ApplicationSubmitted;
use App\Models\Application;
use App\Models\EmailLog;
use App\Models\StudentLetter;
use App\Models\UserInfo;
use Mail;

class SendStudentEmail
{
   public function sendEmail($studentApplications, $letter){
        
        $userInfos = UserInfo::select('email_address', 'id')
                                ->whereIn('id', $studentApplications->pluck('user_info_id', 'user_info_id'))
                                ->get();

        
        $emailLogs = EmailLog::whereIn('user_info_id', $studentApplications->pluck('user_info_id', 'user_info_id'))
                            ->whereIn('qualification_id', $studentApplications->pluck('qualification_id', 'qualification_id'))
                            ->whereIn('campus_id', $studentApplications->pluck('campus_id', 'campus_id'))
                            ->whereIn('academic_year_id', $studentApplications->pluck('academic_year_id', 'academic_year_id'))
                            ->whereIn('academic_intake_id', $studentApplications->pluck('academic_intake_id', 'academic_intake_id'))
                            ->whereIn('admission_status_id', $studentApplications->pluck('application_status' , 'application_status'))
                            ->get();
        
        foreach ($studentApplications as $key => $application) {

            $userInfo = $userInfos->where('id', $application->user_info_id)->first();

            $emailLog = $emailLogs->where('user_info_id', $userInfo->id)
                                ->where('student_letter_id', $letter->id)
                                ->first();
            
            if (!$emailLog) {

                if (filter_var($userInfo->email_address, FILTER_VALIDATE_EMAIL)) {
                    
                    Mail::to($userInfo->email_address)->send(new ApplicationSubmitted($application, $letter));

                    EmailLog::create([
                            'user_info_id' => $application->user_info_id,
                            'student_letter_id' => $letter->id,
                            'qualification_id' => $application->qualification_id,
                            'campus_id' => $application->campus_id,
                            'academic_year_id' => $application->academic_year_id,
                            'academic_intake_id' => $application->academic_intake_id,
                            'admission_status_id' => $application->application_status,
                        ]);
                }
            } 
        }
   }
}
