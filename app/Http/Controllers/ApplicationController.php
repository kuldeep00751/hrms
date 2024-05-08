<?php

namespace App\Http\Controllers;

use App\Actions\Helper;
use Illuminate\Http\Request;
use App\Http\Requests\ApplicationRequest;
use App\Models\AcademicProcess;
use App\Models\AcademicYear;
use App\Models\Application;
use App\Models\Campus;
use App\Models\Qualification;
use App\Models\StudyMode;
use App\Models\UserInfo;
use Exception;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Helper $helper){
        $info = auth()->user()->info;

        $applications = $info->applications;
        
        $allowed_applications = $helper->getListOfValue('ALLOWED_NUMBER_OF_ACADEMIC_APPLICATIONS');

        return view('pages.student.applications.index', compact('info', 'applications', 'allowed_applications'));
    }

    public function create(Helper $helper){
        $info = auth()->user()->info;

        $applications = $info->applications->where('academic_yeard_id', $this->getOpenAcademicYearId());
        
        $allowed_applications = $helper->getListOfValue('ALLOWED_NUMBER_OF_ACADEMIC_APPLICATIONS');

        if(count($applications) >= $allowed_applications){
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'You have exceeded number of applications allowed per academic in-take. You are only allowed '. $allowed_applications.' application(s).']);
        }

        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();

        $applicationAcademicProcess = $helper->getApplicationAcademicProcess();
        
        $choice_number = count($applications) + 1;

        return view('pages.student.applications.create', compact('info', 'qualifications', 'applicationAcademicProcess', 'choice_number'));
    }

    public function getOpenAcademicYearId()
    {
        $currentDate = now(); // Get the current date

        // Query the academic_processes table to find the open academic year
        $openAcademicYear = AcademicProcess::whereDate('start_date', '<=', $currentDate)
            ->whereDate('end_date', '>=', $currentDate)
            ->where('process_name', 'Application')
            ->first();

        // If there's an open academic year, return its ID. Otherwise, return null.
        if ($openAcademicYear) {
            return $openAcademicYear->academic_year_id;
        } else {
            return null;
        }
    }

    public function store(ApplicationRequest $request){
        try {
            $user_info = auth()->user()->info;
            
            if(!isset($user_info->student_number)){
                $academicYear = AcademicYear::find($request->academic_year_id);

                $student_number = $this->generateStudentNumber($academicYear->name);

                $userInfo = UserInfo::find($request->user_info_id);
                $userInfo->student_number = $student_number;
                $userInfo->save();
            }

            $qualification = Qualification::find($request->qualification_id);
            
            $application = Application::where('academic_year_id', $request->academic_year_id)
                ->where('academic_intake_id', $request->academic_intake_id)
                ->where('qualification_id', $request->qualification_id)
                ->where('user_info_id', $user_info->id)
                ->first();

            if ($application) {
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'You have already applied for this qualification.']);
            }

            Application::create(array_merge($request->all(), ['application_type_id' => $qualification->qualification_type_id]));

            return redirect()->route('application.index')
            ->with('success_message', 'Thank you for submitting your application.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    private function generateStudentNumber($academicYear){
        $student_number = $academicYear."".rand(10000,99999);

        $userInfo = UserInfo::where('student_number', $student_number)->first();

        if(!$userInfo){
            return $student_number;
        }

        $this->generateStudentNumber($academicYear);
    }

    public function show($id){
        $application = Application::with('userInfo', 'admissionStatus')->find($id);
        
        return view('pages.student.applications.show', compact('application'));
    }

    public function edit($id, Helper $helper){

        $info = auth()->user()->info;

        $application = Application::find($id);

        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();
        
        $qualificationStudyModes = $application->qualification->studyModes->pluck('study_mode_id');

        $qualificationCampuses = $application->qualification->campuses->pluck('campus_id');

        $applicationAcademicProcess = $helper->getApplicationAcademicProcess();

        if (count($applicationAcademicProcess) == 0) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'The institution is not allowing updating of or new applications at the moment.']);
        }

        $choice_number = $application->choice_number;

        $studyModes = StudyMode::whereIn('id', $qualificationStudyModes)->pluck('study_mode', 'id')->all();

        $campuses = Campus::whereIn('id', $qualificationCampuses)->pluck('name', 'id')->all();

        return view('pages.student.applications.edit',
        compact('application', 'qualifications', 'choice_number', 'info', 'applicationAcademicProcess', 'studyModes', 'campuses'));
    }

    public function update(Request $request, $id)
    {

        try {
            $application = Application::find($id);

            $userInfo = $application->userInfo;

            $application->update($request->all());


            return redirect()->route('application.index')
                ->with('success_message', 'Application successfully updated.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

}
