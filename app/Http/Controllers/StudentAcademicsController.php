<?php

namespace App\Http\Controllers;

use App\Actions\MarksSuppression;
use App\Models\AcademicYear;
use App\Models\CaMarkTypes;
use App\Models\ClassNote;
use App\Models\ExamModulePaper;
use App\Models\Lov;
use App\Models\Module;
use App\Models\ModuleRegistration;
use App\Models\Registration;
use App\Models\StudentCa;
use App\Models\StudentExamination;
use App\Models\StudentSubjectDetail;
use Illuminate\Http\Request;

class StudentAcademicsController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'blocked']);
        
    }

    public function proofOfRegistration()
    {
        $userInfo = auth()->user()->info;
        
        $studentRegistration = Registration::where('user_info_id', $userInfo->id)
                                            ->where('registration_status_id', 1)
                                            ->get();
        
        return view('pages.student.academic.por.index', compact('userInfo', 'studentRegistration'));
    }

    public function showProofOfRegistration($id)
    {
        $studentRegistration = Registration::with('userInfo', 'qualification', 'studyMode', 'yearLevel', 'campus', 'academicYear', 'academicIntake')->find($id);

        $moduleRegistration = ModuleRegistration::with('studyMode', 'module', 'studyPeriod', 'academicIntake')
                                                ->where('user_info_id', $studentRegistration->user_info_id)
                                                ->where('academic_year_id', $studentRegistration->academic_year_id)
                                                ->where('campus_id', $studentRegistration->campus_id)
                                                ->where('is_cancelled', 0)
                                                ->get();

        return view('pages.student.academic.por.show', compact('studentRegistration', 'moduleRegistration'));
    }

    public function printProofOfRegistration($id)
    {
        $lov = Lov::all();

        $studentRegistration = Registration::with('userInfo', 'qualification', 'studyMode', 'yearLevel', 'campus', 'academicYear', 'academicIntake')->find($id);

        $moduleRegistration = ModuleRegistration::with('studyMode', 'module', 'studyPeriod', 'academicIntake')
                                                ->where('user_info_id', $studentRegistration->user_info_id)
                                                ->where('academic_year_id', $studentRegistration->academic_year_id)
                                                ->where('campus_id', $studentRegistration->campus_id)
                                                ->where('is_cancelled', 0)
                                                ->get();

        return view('pages.student.academic.por.print', compact('studentRegistration', 'moduleRegistration', 'lov'));
    }

    public function assessment()
    {
        
        $userInfo = auth()->user()->info;

        $registrations = Registration::where('user_info_id', $userInfo->id)
                                        ->where('promotion_status', 0)
                                        ->get();
        
        $moduleRegistrations = [];

        if(count($registrations)){

            $moduleRegistrations = ModuleRegistration::with('studyPeriod', 'studyMode', 'academicIntake', 'module')
                                                    ->where('user_info_id', $userInfo->id)
                                                    ->whereIn('academic_year_id', $registrations->pluck('academic_year_id'))
                                                    ->where('is_cancelled', 0)
                                                    ->get();
            
        }

        return view('pages.student.academic.assessments.index', compact('userInfo', 'moduleRegistrations'));
    }

    public function viewAssessment($id, MarksSuppression $suppression)
    {

        $moduleRegistration = ModuleRegistration::with('userInfo','studyPeriod', 'studyMode', 'academicIntake', 'module')
                                                ->find($id);
        
        $suppressCa = false;

        $assessmentMarks = CaMarkTypes::with('markType')
                                        ->where('user_info_id', $moduleRegistration->user_info_id)
                                        ->where('module_id', $moduleRegistration->module_id)
                                        ->where('academic_year_id', $moduleRegistration->academic_year_id)
                                        ->where('study_mode_id', $moduleRegistration->study_mode_id)
                                        ->where('campus_id', $moduleRegistration->campus_id)
                                        ->where('academic_intake_id', $moduleRegistration->academic_intake_id)
                                        ->get();
    

        $studentCa = StudentCa::where('user_info_id', $moduleRegistration->user_info_id)
                                    ->where('module_id', $moduleRegistration->module_id)
                                    ->where('academic_year_id', $moduleRegistration->academic_year_id)
                                    ->where('study_mode_id', $moduleRegistration->study_mode_id)
                                    ->where('campus_id', $moduleRegistration->campus_id)
                                    ->where('academic_intake_id', $moduleRegistration->academic_intake_id)
                                    ->first();
        if($studentCa){
            if ($suppression->isSuppressed($studentCa, 'CA')) {
                $suppressCa = true;
            }
        }
      
        
        return view('pages.student.academic.assessments.show', compact('assessmentMarks', 'moduleRegistration', 'studentCa', 'suppressCa'));
    }

    public function examinations()
    {
        $userInfo = auth()->user()->info;

        $moduleRegistrations = [];

        if (count($userInfo->registration)) {

            $userInfo = auth()->user()->info;

            $academicYear = AcademicYear::where('name', date('Y'))->first();

            $moduleRegistrations = ModuleRegistration::with('studyPeriod', 'studyMode', 'academicIntake', 'module')
                                                    ->where('user_info_id', $userInfo->id)
                                                    ->where('academic_year_id', $academicYear->id)
                                                    ->where('is_cancelled', 0)
                                                    ->get();
        }
        
        return view('pages.student.academic.examinations.index', compact('userInfo', 'moduleRegistrations'));
    }

    public function viewExaminations($id, MarksSuppression $suppression)
    {

        $moduleRegistration = ModuleRegistration::with('userInfo', 'studyPeriod', 'studyMode', 'academicIntake', 'module')
                                                ->find($id);

        $moduleExamPapers = ExamModulePaper::with('examPaper')
                                            ->where('user_info_id', $moduleRegistration->user_info_id)
                                            ->where('module_id', $moduleRegistration->module_id)
                                            ->where('academic_year_id', $moduleRegistration->academic_year_id)
                                            ->where('study_mode_id', $moduleRegistration->study_mode_id)
                                            ->where('campus_id', $moduleRegistration->campus_id)
                                            ->where('academic_intake_id', $moduleRegistration->academic_intake_id)
                                            ->get();

        $studentExamination = StudentExamination::where('user_info_id', $moduleRegistration->user_info_id)
                                                ->where('module_id', $moduleRegistration->module_id)
                                                ->where('academic_year_id', $moduleRegistration->academic_year_id)
                                                ->where('study_mode_id', $moduleRegistration->study_mode_id)
                                                ->where('campus_id', $moduleRegistration->campus_id)
                                                ->where('academic_intake_id', $moduleRegistration->academic_intake_id)
                                                ->first();
        $suppress = false;

        if ($studentExamination) {
            if ($suppression->isSuppressed($studentExamination, 'Exam Marks')) {
                $suppress = true;
            }
        }

        return view('pages.student.academic.examinations.show', compact('moduleExamPapers', 'moduleRegistration', 'studentExamination', 'suppress'));
    }

    public function academicTranscript(){
        
        $userInfo = auth()->user()->info;

        

        $studentRegistration = Registration::where('user_info_id', $userInfo->id)
                                            ->where('registration_status_id', 1)
                                            ->get();

        return view('pages.student.academic.transcript.index', compact('userInfo', 'studentRegistration'));
    }

    public function viewAcademicTranscript($id, MarksSuppression $suppression){

        $registration = Registration::find($id);

        $subjectDetails = StudentSubjectDetail::where('academic_year_id', $registration->academic_year_id)
                                                ->where('qualification_id', $registration->qualification_id)
                                                ->where('is_cancelled', 0)
                                                ->where('user_info_id', $registration->user_info_id)
                                                ->get();

        $suppress = false;

        if (count($subjectDetails)) {
            if ($suppression->isSuppressed($subjectDetails->first(), 'Final Mark')) {
                $suppress = true;
            }
        }
        
        return view('pages.student.academic.transcript.show', compact('subjectDetails', 'registration', 'suppress'));
    }

    public function printAcademicTranscript($id, MarksSuppression $suppression)
    {
        $lov = Lov::all();

        $registration = Registration::find($id);

        $subjectDetails = StudentSubjectDetail::where('academic_year_id', $registration->academic_year_id)
            ->where('qualification_id', $registration->qualification_id)
            ->where('user_info_id', $registration->user_info_id)
            ->get();

        $suppress = false;

        if (count($subjectDetails)) {
            if ($suppression->isSuppressed($subjectDetails->first(), 'Final Mark')) {
                $suppress = true;
            }
        }

        return view('pages.student.academic.transcript.print', compact('subjectDetails', 'suppress', 'lov'));
    }


    public function showStudentModules(){
        $userInfo = auth()->user()->info;

        $academicYear = AcademicYear::where('name', date('Y'))->first();

        $studentRegistration = Registration::with('userInfo', 'qualification', 'studyMode', 'yearLevel', 'campus', 'academicYear', 'academicIntake')
                                            ->where('academic_year_id', $academicYear->id)
                                            ->where('user_info_id', $userInfo->id)
                                            ->first();
        if(!$studentRegistration){
            return back()->withErrors(['unexpected_error' => 'You are not registered for this academic year']);
        }
        $moduleRegistration = ModuleRegistration::with('studyMode', 'module', 'studyPeriod', 'academicIntake')
                                            ->where('user_info_id', $studentRegistration->user_info_id)
                                            ->where('academic_year_id', $studentRegistration->academic_year_id)
                                            ->where('campus_id', $studentRegistration->campus_id)
                                            ->where('is_cancelled', 0)
                                            ->get();

        return view('pages.student.academic.my_modules.show', compact('studentRegistration', 'moduleRegistration'));
    }

    public function showClassNotes($id){

        $module = Module::find($id);

        $classNotes = ClassNote::where('module_id', $id)->get();

        return view('pages.student.academic.my_modules.notes', compact('module', 'classNotes'));
    }

}
