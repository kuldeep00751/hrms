<?php

namespace App\Http\Controllers;

use App\Actions\Helper;
use App\DataTables\StudentBioDataTable;
use App\Models\AcademicIntake;
use App\Models\AcademicProcess;
use App\Models\AcademicYear;
use App\Models\Application;
use App\Models\ApplicationType;
use App\Models\Campus;
use App\Models\Country;
use App\Models\EducationSystem;
use App\Models\GenderType;
use App\Models\MatricType;
use App\Models\NextOfKinRelationship;
use App\Models\Qualification;
use App\Models\Registration;
use App\Models\RequiredDocument;
use App\Models\SchoolSubject;
use App\Models\StudentDocument;
use App\Models\StudentEnrolment;
use App\Models\StudentSubjectDetail;
use App\Models\StudentType;
use App\Models\StudyMode;
use App\Models\Title;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UserInfoSchoolSubjects;
use Exception;
use Hash;
use Auth;
use Illuminate\Http\Request;

class UserInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StudentBioDataTable $dataTable)
    {

        return $dataTable->render('pages.applications.user_info.index');
        
        //return view('pages.applications.user_info.index', compact('userInfos', 'filterData'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('pages.applications.user_info.account');
    }

    public function createUserInfo(Helper $helper, $id)
    {
        
        $info = UserInfo::find($id);

        $titles = Title::where('active', 1)->pluck('title', 'id')->all();

        $genderTypes = GenderType::pluck('gender_type', 'id')->all();

        $educationSystems = EducationSystem::pluck('system_name', 'id')->all();

        $schoolSubjects = SchoolSubject::pluck('subject_name', 'id')->all();

        $matricTypes = MatricType::distinct()->select('matric_type')->pluck('matric_type', 'matric_type')->all();

        $gradingScale = MatricType::distinct()->select('matric_type', 'grade', 'points')->get();

        $userSchoolSubjects = UserInfoSchoolSubjects::with('subject')->where('user_info_id', $info->id)->get();

        $nextOfKinRelationships = NextOfKinRelationship::where('active',1)->pluck('relationship', 'id')->all();

        $academicIntake = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $campus = Campus::pluck('name', 'id')->all();

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $countries = Country::pluck('name', 'id')->all();

        $applicationTypes = ApplicationType::where('active', 1)->pluck('application_type', 'id')->all();

        $qualifications = Qualification::with('qualificationType')->get();

        $studentTypes = StudentType::where('active', 1)->pluck('student_type', 'id')->all();

        $campuses = Campus::where('active', 1)->pluck('name', 'id')->all();

        $allowed_applications = $helper->getListOfValue('ALLOWED_NUMBER_OF_ACADEMIC_APPLICATIONS');
        
        $currentAcademicYearId = $this->getOpenAcademicYearId();

        $applications = $info->applications->where('academic_year_id', $currentAcademicYearId);

        $allowApplicatioNSubmission = true;
        
        if (count($applications) >= $allowed_applications) {
            $allowApplicatioNSubmission = false;
        }

        $qualifications = Qualification::where('active', 1)->pluck('qualification_name', 'id')->all();

        $applicationAcademicProcess = $helper->getApplicationAcademicProcess();

        
        if (!count($applicationAcademicProcess)) {
            $allowApplicatioNSubmission = false;
        }
        
        $choice_number = count($applications) + 1;

        $requiredDocuments = RequiredDocument::where('active', 1)->get();

        $studentDocuments = StudentDocument::where('user_info_id', $info->id)->get();
        
        return view('pages.applications.user_info.create', compact('info', 'campuses', 'choice_number', 'qualifications', 'applications','allowApplicatioNSubmission','applicationAcademicProcess','titles', 'genderTypes', 'nextOfKinRelationships', 'educationSystems', 'schoolSubjects', 'matricTypes', 'gradingScale', 'qualifications', 'academicIntake', 'campus', 'studyModes', 'countries', 'applicationTypes', 'userSchoolSubjects', 'studentTypes', 'requiredDocuments', 'studentDocuments'));
    }
    
    public function getOpenAcademicYearId()
    {
        
        $currentDate = date('Y-m-d'); // Get the current date
        
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
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            $data['password'] = Hash::make($data['password']);

            $user = User::create($data);

            $userInfo = new UserInfo;
            $userInfo->user_id  = $user->id;
            $userInfo->surname  = $user->last_name;
            $userInfo->first_names  = $user->first_name;
            $userInfo->email_address  = $user->email;
            $userInfo->save();

            return redirect()->route('user_infos.user_info.create_user_info', $userInfo->id)
            ->with('success_message', 'User was successfully added.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userInfo = UserInfo::with('nextOfKin', 'schoolSubjects', 'previousQualification', 'healthQuestionnaire', 'employment', 'educationSystem', 'documents')->findOrFail($id);

        $section = 'show';

        return view('pages.applications.user_info.show', compact('userInfo', 'section'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         return redirect()->route('user_infos.user_info.create_user_info', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userInfoApplications($id, Helper $helper)
    {
        $info = UserInfo::find($id);

        $applications = $info->applications;

        $allowed_applications = $helper->getListOfValue('ALLOWED_NUMBER_OF_ACADEMIC_APPLICATIONS');
        
        return view('pages.applications.user_info.applications', compact('info', 'applications', 'allowed_applications'));
    }

    public function editApplication($id, Helper $helper){

        $application = Application::find($id);
        
        $info = $application->userInfo;

        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();

        $qualificationStudyModes = $application->qualification->studyModes->pluck('study_mode_id');

        $qualificationCampuses = $application->qualification->campuses->pluck('campus_id');
        
        $studyModes = StudyMode::whereIn('id', $qualificationStudyModes)->pluck('study_mode', 'id')->all();
        
        $campuses = Campus::whereIn('id', $qualificationCampuses)->pluck('name', 'id')->all();
        
        $applicationAcademicProcess = $helper->getApplicationAcademicProcess();

        if (count($applicationAcademicProcess) == 0) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'The institution is not allowing updating of or new applications at the moment.']);
        }

        $choice_number = $application->choice_number;

        return view('pages.applications.user_info.edit-applications', compact('application', 'qualifications','choice_number', 'info', 'applicationAcademicProcess', 'studyModes','campuses'));
    }

    public function createApplication($id, Helper $helper)
    {
        $info = UserInfo::find($id);

        $currentAcademicYearId = $this->getOpenAcademicYearId();
        
        $applications = $info->applications->where('academic_year_id', $currentAcademicYearId);

        $allowed_applications = $helper->getListOfValue('ALLOWED_NUMBER_OF_ACADEMIC_APPLICATIONS');
        
        if (count($applications) >= $allowed_applications) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'You have exceeded number of applications allowed per academic in-take. You are only allowed ' . $allowed_applications . ' application(s).']);
        }
        
        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();

        $applicationAcademicProcess = $helper->getApplicationAcademicProcess();

        $choice_number = count($applications) + 1;

        return view('pages.applications.user_info.create-applications', compact('info', 'qualifications', 'applicationAcademicProcess', 'choice_number'));
    }

    public function registrationInfo($id){

        $registrations = StudentEnrolment::where('user_info_id', $id)->get();

        $moduleRegistrations = StudentSubjectDetail::where('user_info_id', $id)->get();

        $userInfo = UserInfo::find($id);

        $section = 'registration';

        return view('pages.applications.user_info.registration', compact('registrations', 'userInfo', 'section', 'moduleRegistrations'));
    }

    public function storeApplication(Request $request, $id, Helper $helper){
        
        try {
            $user_info = UserInfo::find($id);

            if (!isset($user_info->student_number)) {
                $academicYear = AcademicYear::find($request->academic_year_id);

                $student_number = $this->generateStudentNumber($academicYear->name);

                $userInfo = UserInfo::find($request->user_info_id);
                $userInfo->student_number = $student_number;
                $userInfo->save();
            }
            
            $qualification = Qualification::find($request->qualification_id);

            $application = Application::where('academic_year_id', $request->academic_year_id)
                                        ->where('qualification_id', $request->qualification_id)
                                        ->where('user_info_id', $user_info->id)
                                        ->first();
            
            if($application){
                return back()->withInput()
                ->withErrors(['unexpected_error' => 'You have already applied for this qualification.']);
            }
            
            $applications = $user_info->applications->where('academic_year_id', $request->academic_year_id);

            $allowed_applications = $helper->getListOfValue('ALLOWED_NUMBER_OF_ACADEMIC_APPLICATIONS');
                
            if (count($applications) >= $allowed_applications) {

                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'You have exceeded number of applications allowed per academic in-take. You are only allowed ' . $allowed_applications . ' application(s).']);
            }
            
            $application = Application::create(array_merge($request->all(), ['application_type_id' => $qualification->qualification_type_id]));
            
            return redirect()->route('user_infos.user_info.applications', $user_info->id)
            ->with('success_message', 'Thank you for submitting your application.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function updateApplication(Request $request, $id)
    {

        try {
            $application = Application::find($id);

            $userInfo = $application->userInfo;

            $application->update($request->all());


            return redirect()->route('user_infos.user_info.applications', $userInfo->id)
                ->with('success_message', 'Application successfully updated.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    private function generateStudentNumber($academicYear)
    {
        $student_number = $academicYear . "" . rand(10000, 99999);

        $userInfo = UserInfo::where('student_number', $student_number)->first();

        if (!$userInfo) {
            return $student_number;
        }

        $this->generateStudentNumber($academicYear);
    }

    public function userInfoDocuments($id)
    {
        $info = UserInfo::find($id);

        $studentDocuments = StudentDocument::where('user_info_id', $info->id)->get();

        $requiredDocuments = RequiredDocument::all();

        return view('pages.applications.user_info.documents', compact('info', 'studentDocuments', 'requiredDocuments'));
    }

    public function userInfoAccount($id){

        $userInfo = UserInfo::find($id);

        $section = 'account';

        return view('pages.applications.user_info.update-account', compact('userInfo', 'section'));
    }

    public function updateUserInfoAccount(Request $request, $id){
        try {
            $userInfo = UserInfo::find($id);

            if (isset($request->email)) {
                $request->validate([
                    'email' => 'string|min:1|required|unique:users,id,' . $userInfo->user_id,
                ]);

                $user = $userInfo->user;

                $user->update(['email' => $request->email]);
                $userInfo->update(['email_address' => $request->email]);
            }

            if (isset($request->password)) {
                $request->validate([
                    'password' => 'required|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                ]);

                $user = $userInfo->user;

                $user->update(['password' => Hash::make($request->password)]);
            }

            $section = 'account';

            return redirect()->route('user_infos.user_info.account', $userInfo->id)
            ->with('success_message', 'Student Account was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function impersonate($userInfo){
        $user = UserInfo::find($userInfo)->user;

        Auth::user()->impersonate($user);

        return redirect()->route('student.dashboard');

    }

    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {

        $rules = [
            'first_name' => 'string|min:1|required',
            'last_name' => 'string|min:1|required',
            'email' => 'email|min:1|required|unique:users',
            'password' => 'required'
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
