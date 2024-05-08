<?php

namespace App\Http\Controllers;

use App\Models\AcademicIntake;
use App\Models\AcademicYear;
use App\Models\ApplicationType;
use App\Models\Campus;
use App\Models\PromotionStatus;
use App\Models\Qualification;
use App\Models\Registration;
use App\Models\StudentFinalMark;
use App\Models\StudentSubjectDetail;
use App\Models\StudyMode;
use App\Models\UserInfo;
use App\Models\YearLevel;
use Exception;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        session()->forget('academic_year');
        session()->forget('academic_intake');
        session()->forget('year_level');
        session()->forget('qualification');
        session()->forget('study_mode');
        session()->forget('campus');
        session()->forget('student_number');

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $yearLevels = YearLevel::pluck('year_level', 'id')->all();

        $registrations = array();

        $filterData = [];

        return view('pages.promotion.index', compact('academicYears', 'academicIntakes', 'qualifications', 'studyModes', 'campuses', 'yearLevels', 'registrations'));
    }

    private function applyFilters($registrations, $filterData)
    {

        if (isset($filterData['academic_year'])) {
            $registrations = $registrations->where('academic_year_id', $filterData['academic_year']);
        }

        if (isset($filterData['academic_intake'])) {
            $registrations = $registrations->where('academic_intake_id', $filterData['academic_intake']);
        }

        if (isset($filterData['campus'])) {
            $registrations = $registrations->where('campus_id', $filterData['campus']);
        }

        if (isset($filterData['year_level'])) {
            $registrations = $registrations->where('year_level_id', $filterData['year_level']);
        }

        if (isset($filterData['study_mode'])) {
            $registrations = $registrations->where('study_mode_id', $filterData['study_mode']);
        }

        if (isset($filterData['qualification'])) {
            $registrations = $registrations->where('qualification_id', $filterData['qualification']);
        }

        if (isset($filterData['student_number'])) {
            $userInfo = UserInfo::select('id')->where('student_number', $filterData['student_number'])->first();

            $registrations = $registrations->where('user_info_id', $userInfo->id);
        }

        
        return $registrations->get();
    }


    private function filterData($request)
    {
        $academic_year = session()->get('academic_year');
        $academic_intake = session()->get('academic_intake');
        $year_level = session()->get('year_level');
        $qualification = session()->get('qualification');
        $study_mode = session()->get('study_mode');
        $campus = session()->get('campus');
        $student_number = session()->get('student_number');

        if (count($request->all())) {

            session()->put('academic_year', $request->academic_year);
            session()->put('academic_intake', $request->academic_intake);
            session()->put('year_level', $request->year_level);
            session()->put('qualification', $request->qualification);
            session()->put('study_mode', $request->study_mode);
            session()->put('campus', $request->campus);
            session()->put('student_number', $request->student_number);

            return $request->all();
        } else {
            return [
                'academic_year' => $academic_year,
                'academic_intake' => $academic_intake,
                'year_level' => $year_level,
                'qualification' => $qualification,
                'study_mode' => $study_mode,
                'campus' => $campus,
                'student_number' => $student_number
            ];
        }
    }

    public function filter(Request $request)
    {

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $yearLevels = YearLevel::pluck('year_level', 'id')->all();

        $filterData = $this->filterData($request);

        $registrations = Registration::with('yearLevel', 'academicYear', 'academicIntake', 'qualification', 'studyMode', 'userInfo')
                        ->where('registration_status_id', 1);

        $registrations = $this->applyFilters($registrations, $filterData);

        return view('pages.promotion.index', compact('academicYears', 'academicIntakes', 'qualifications', 'studyModes', 'campuses', 'yearLevels', 'registrations', 'filterData'));
    }

    
    public function store(Request $request)
    {
        
        try {
            $modulesWithoutMarks = StudentSubjectDetail::where('year_level_id', $request->year_level_id)
                                                        ->where('academic_year_id', $request->academic_year)
                                                        ->where('qualification_id', $request->qualification)
                                                        ->where('user_info_id', $request->user_info_id)
                                                        ->whereNull('result_code')
                                                        ->get();
            if(count($modulesWithoutMarks)){
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Error while trying to promote student. Please capture all the marks.']);
            }

            $studentRegistration = Registration::with('userInfo', 'qualification', 'academicYear', 'yearLevel')->find($request->registration_id);

            $studentRegistration->promotion_status = $request->promotion_status_id;

            $studentRegistration->updated_by = auth()->user()->id;

            $studentRegistration->save();

        } catch (Exception $e) {
            return back()->withInput()
                 ->withErrors(['unexpected_error' => 'An error occured while trying to process your request']);
        }
       

        // $promotion_status = PromotionStatus::find($request->promotion_status_id);

        // $academicYearId = $this->getNextAcademicYearId($studentRegistration);
        
        // if(!$academicYearId){
        //     return back()->withInput()
        //         ->withErrors(['unexpected_error' => 'Next academic year not found on the system. This is can be defined under System, Settings and Academic Years.']);
        // }
        
        // if($promotion_status->promoted){

        //     $isFinalYear = $this->isFinalYear($studentRegistration);
            

        //     if(!$isFinalYear){
        //         $this->createStudentRegistrationRecord($studentRegistration, $academicYearId, $request);
        //     }
            
        // }
        
        return back()->withInput()
        ->with('success_message', $studentRegistration->userInfo->first_names.' '. $studentRegistration->userInfo->surname.' promotion status successfully updated!');

       // return view('pages.promotion.index', compact('academicYears', 'academicIntakes', 'qualifications', 'studyModes', 'campuses', 'yearLevels', 'registrations', 'filterData'));
    }

    private function isFinalYear($studentRegistration){
        $number_of_years = intval($studentRegistration->qualification->number_of_years);
        
        $new_year_level = intval($studentRegistration->yearLevel->year_level) + 1;
        
        if($new_year_level > $number_of_years){
            return true;
        } else {
            return false;
        }
    }

    

    private function getNextAcademicYearId($studentRegistration){
        $currentAcademicYear = intval($studentRegistration->academicYear->name);
        
        $currentAcademicYear = $currentAcademicYear + 1;

        $nextAcademicYear = AcademicYear::where('name', $currentAcademicYear)->first();
        
        if($nextAcademicYear){
            return $nextAcademicYear->id;
        }

        return false;
    }

    public function studentTranscript($registrationId){
        
        $studentRegistration = Registration::with('qualification', 'userInfo')->find($registrationId);

        $subjectDetails = StudentSubjectDetail::where('user_info_id', $studentRegistration->user_info_id)
                                        ->where('qualification_id', $studentRegistration->qualification_id)
                                        ->where('academic_year_id', $studentRegistration->academic_year_id)
                                        ->get();

        $yearLevels = $subjectDetails->pluck('year_level_id', 'year_level_id')->all();

        $promotionStatuses = PromotionStatus::where('active', 1)->pluck('description', 'id')->all();

        return view('pages.promotion.transcript', compact('subjectDetails', 'studentRegistration', 'yearLevels', 'promotionStatuses'))->render();
        
    }
}
