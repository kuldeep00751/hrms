<?php

namespace App\Http\Controllers\Account;

use App\Actions\CreateApplication;
use App\Actions\CreateEmployment;
use App\Actions\CreateHealthQuestionnaire;
use App\Actions\CreateNextOfKin;
use App\Actions\CreatePreviousQualification;
use App\Actions\CreateSchoolLeavingSubjects;
use App\Actions\Helper;
use App\Actions\SendStudentEmail;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\SettingsEmailRequest;
use App\Http\Requests\Account\SettingsInfoRequest;
use App\Http\Requests\Account\SettingsPasswordRequest;
use App\Models\AcademicIntake;
use App\Models\AcademicProcess;
use App\Models\AcademicYear;
use App\Models\Application;
use App\Models\ApplicationType;
use App\Models\Campus;
use App\Models\Country;
use App\Models\EducationSystem;
use App\Models\GenderType;
use App\Models\HealthQuestionnaire;
use App\Models\Lov;
use App\Models\MatricType;
use App\Models\NextOfKinRelationship;
use App\Models\Qualification;
use App\Models\RequiredDocument;
use App\Models\SchoolSubject;
use App\Models\StudentDocument;
use App\Models\StudentLetter;
use App\Models\StudentType;
use App\Models\StudyMode;
use App\Models\Title;
use App\Models\UserInfo;
use App\Models\UserInfoNextOfKin;
use App\Models\UserInfoPreviousQualification;
use App\Models\UserInfoSchoolSubjects;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use View;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Helper $helper)
    {
        $info = auth()->user()->info;
        
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

        $studentTypes = StudentType::where('active', 1)->pluck('student_type', 'id')->all();

        $countries = Country::pluck('name', 'id')->all();

        $applicationTypes = ApplicationType::where('active', 1)->pluck('application_type', 'id')->all();

        $qualifications = Qualification::with('qualificationType')
                        ->where('active', 1)
                        ->get();

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
        
        // get the default inner page
        return view('pages.account.settings.settings', compact('info', 'studentDocuments', 'applications','requiredDocuments', 'choice_number', 'campuses', 'qualifications', 'applicationAcademicProcess','allowApplicatioNSubmission', 'titles', 'genderTypes', 'nextOfKinRelationships', 'educationSystems', 'userSchoolSubjects', 'schoolSubjects', 'matricTypes', 'gradingScale', 'qualifications', 'academicIntake', 'campus', 'studyModes', 'countries', 'applicationTypes', 'studentTypes'));
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SettingsInfoRequest $request, CreateNextOfKin $nextOfKin, CreateSchoolLeavingSubjects $schoolSubjects, CreatePreviousQualification $previousQualification, CreateHealthQuestionnaire $healthQuestionnaire, CreateEmployment $employment, Helper $helper, SendStudentEmail $studentEmail)
    {
        // save user name
        $userInfoId = 0;

        if(auth()->user()->user_type == 'Student'){
            $userInfoId = auth()->user()->id;
            auth()->user()->update([
                'first_name' => $request->first_names,
                'last_name' => $request->surname,
            ]);

            $info = UserInfo::where('user_id', auth()->user()->id)->first();

            if ($info === null) {
                // create new model
                $info = new UserInfo();
            }

            // attach this info to the current user
            $info->user()->associate(auth()->user());
        } else {
            $info = UserInfo::where('email_address', $request->email_address)->first();
            $userInfoId = $info->id;
            $info->user()->update([
                'first_name' => $request->first_names,
                'last_name' => $request->surname,
            ]);
        }
    

        foreach ($request->only(array_keys($request->rules())) as $key => $value) {
            if (is_array($value)) {
                $value = serialize($value);
            }
            $info->$key = $value;
        }

        // include to save avatar
        if ($avatar = $this->upload()) {
            $info->passport_photo = $avatar;
        }

        if ($request->boolean('avatar_remove')) {
            Storage::delete($info->passport_photo);
            $info->passport_photo = null;
        }
        
        $info->save();

        $validatedNextOfKin = $request->validate([
            'nok_relationship_id' => 'required',
            'nok_full_names' => 'required',
            'nok_contact_number' => 'required',
            'nok_id_number' => 'nullable',
            'nok_address_line1' => 'nullable',
            'nok_town' => 'nullable',
            'nok_suburb' => 'nullable',
            'nok_country_id' => 'nullable'
        ]);
        
        $nextOfKin->create($validatedNextOfKin, $info);

        $validatedPreviousQualificationData = $request->validate([
            'level_id' => 'nullable',
            'student_number' => 'nullable',
            'institution' => 'nullable',
            'qualification_name' => 'nullable',
            'awarded_yn' => 'nullable',
            'from_date' => 'nullable',
            'to_date' => 'nullable',
            'previous_qualification_document' => 'nullable|max:400|sometimes',
        ]);

        $previousQualification->create($validatedPreviousQualificationData, $info);

        $validatedSchoolSubjects = $request->validate([
            'school_subject_id' => 'required',
            'matric_type' => 'required',
            'final_term_result' => 'nullable',
            'final_term_points' => 'nullable',
        ]);

        $schoolSubjects->create($validatedSchoolSubjects, $info);

        $healthQuestionnaire->create($request, $info);

        $employment->create($request, $info);

        $this->uploadStudentDocuments($info, $request);

        $allowed_applications = $helper->getListOfValue('ALLOWED_NUMBER_OF_ACADEMIC_APPLICATIONS');

        $applications = $info->application->where('academic_year_id', $this->getOpenAcademicYearId());

        if(count($applications) <= $allowed_applications){
            $submittedApplications = $this->createApplication($info, $request);
        }

        $lov = Lov::whereIn('label', ['ACKNOWLEDGEMENT_LETTER_ID', 'SEND_ACKNOWLEDGEMENT_LETTER'])->get();

        $sendEmail = $lov->where('label', 'SEND_ACKNOWLEDGEMENT_LETTER')->first();

        $letterId = $lov->where('label', 'ACKNOWLEDGEMENT_LETTER_ID')->first();

        if(($sendEmail) && ($letterId)){
            if ($sendEmail->value == 'Yes') {

                $letter = StudentLetter::find($letterId->value);

                foreach($applications as $application){
                    $studentEmail->sendEmail($applications, $letter);
                }
            }
        }

        return response()->json(['message' => 'success', 'userInfo' => $info]);
    }

    private function createApplication($user_info, $request){
        try {

            $qualification = Qualification::find($request->qualification_id);

            $application = Application::where('academic_year_id', $request->academic_year_id)
                ->where('qualification_id', $request->qualification_id)
                ->where('campus_id', $request->campus_id)
                ->where('user_info_id', $user_info->id)
                ->first();

            if (!$application) {
                $application = Application::create([
                                                'user_info_id' => $user_info->id,
                                                'qualification_id' => $qualification->id,
                                                'application_type_id' => $qualification->qualification_type_id,
                                                'study_mode_id' => $request->study_mode_id,
                                                'campus_id' => $request->campus_id,
                                                'academic_year_id' => $request->academic_year_id,
                                                'academic_intake_id' => $request->academic_intake_id,
                                                'choice_number' => $request->choice_number
                                            ]);
            }

            if (!isset($user_info->student_number)) {
                $academicYear = AcademicYear::find($request->academic_year_id);

                $student_number = $this->generateStudentNumber($academicYear->name);
                
                $user_info->student_number = $student_number;

                $user_info->save();
            }

            return $application;

        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    private function uploadStudentDocuments($user_info, $request){

        try {
            
            $data = $request->all();

            if($request->hasFile('document')){
                
                $documents = $request->file('document');

                $uploadedDocuments = [];

                foreach ($documents as $key => $document) {
                    $path = $document->store('student-documents');
                    $uploadedDocuments[$key] = $path;
                }

                foreach ($uploadedDocuments as $key => $path) {

                    $studentDocument = StudentDocument::where('required_document_id', $key)
                                                        ->where('user_info_id', $user_info->id)
                                                        ->first();

                    if ($studentDocument) {
                        Storage::delete([$studentDocument->document_path]);

                        StudentDocument::where('required_document_id', $key)
                                        ->where('user_info_id', $user_info->id)
                                        ->delete();
                    }

                    StudentDocument::create([
                        'user_info_id' => $user_info->id,
                        'required_document_id' => $key,
                        'document_path' => $path,
                    ]);
                }
            }


        } catch (Exception $exception) {
            dd($exception);
           
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

    /**
     * Function for upload avatar image
     *
     * @param  string  $folder
     * @param  string  $key
     * @param  string  $validation
     *
     * @return false|string|null
     */
    public function upload($folder = 'Images', $key = 'passport_photo', $validation = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|sometimes')
    {
        request()->validate([$key => $validation]);

        $file = null;
        if (request()->hasFile($key)) {
            $file = Storage::disk('public')->putFile($folder, request()->file($key), 'public');
        }

        return $file;
    }

    /**
     * Function to accept request for change email
     *
     * @param  SettingsEmailRequest  $request
     */
    public function changeEmail(SettingsEmailRequest $request)
    {
        // prevent change email for demo account
        if ($request->input('current_email') === 'demo@demo.com') {
            return redirect()->intended('account/settings');
        }

        auth()->user()->update(['email' => $request->input('email')]);

        if ($request->expectsJson()) {
            return response()->json($request->all());
        }

        return redirect()->intended('account/settings');
    }

    /**
     * Function to accept request for change password
     *
     * @param  SettingsPasswordRequest  $request
     */
    public function changePassword(SettingsPasswordRequest $request)
    {
        // prevent change password for demo account
        if ($request->input('current_email') === 'demo@demo.com') {
            return redirect()->intended('account/settings');
        }

        auth()->user()->update(['password' => Hash::make($request->input('password'))]);

        if ($request->expectsJson()) {
            return response()->json($request->all());
        }

        return redirect()->intended('account/settings');
    }


    public function addNextOfKin(){
        $nextOfKinRelationships = NextOfKinRelationship::where('active',1)->pluck('relationship', 'id')->all();
        
        $countries = Country::pluck('name', 'id')->all();
        
        $html = View::make('pages.account.settings._nok', compact('nextOfKinRelationships', 'countries'))->render();
        
        return response()->json(['html' => $html]);
    }

    public function addPreviousQualification()
    {
        $applicationTypes = ApplicationType::where('active', 1)->pluck('application_type', 'id')->all();

        $html = View::make('pages.account.settings._previous-qualification', compact('applicationTypes'))->render();

        return response()->json(['html' => $html]);
    }

    

    public function addApplication(Helper $helper, $id)
    {
        $info = UserInfo::find($id);

        $currentAcademicYearId = $this->getOpenAcademicYearId();
        
        $applications = $info->applications->where('academic_yeard_id', $currentAcademicYearId);

        $allowed_applications = $helper->getListOfValue('ALLOWED_NUMBER_OF_ACADEMIC_APPLICATIONS');

        if (count($applications) >= $allowed_applications) {
            return response()->json(['status' => 0, 'message' => 'You have exceeded number of applications allowed per academic in-take. You are only allowed ' . $allowed_applications . ' application(s).']);
        }

        $qualifications = Qualification::where('active', 1)->pluck('qualification_name', 'id')->all();

        $applicationAcademicProcess = $helper->getApplicationAcademicProcess();

        $choice_number = count($applications) + 1;

        $application = null;
        $studyModes = [];
        $campuses = [];

        $html = View::make('pages.account.settings._application-form', compact('qualifications', 'application', 'studyModes', 'campuses', 'applicationAcademicProcess', 'choice_number'))->render();

        return response()->json(['html' => $html, 'status' => 1]);
    }

    /**
     * Remove the specified academic year from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function deleteNextOfKin($id = null)
    {
        
        try {
            if(!is_null($id))
            {
                $nextOfKin = UserInfoNextOfKin::findOrFail($id);
                $nextOfKin->delete();

                return response()->json(['message' => 'Your record has been deleted.', 'status' => 'success']);
            } else {
                return response()->json(['message' => 'Your record has been deleted.', 'status' => 'success']);
            }
          
        } catch (Exception $exception) {

            return response()->json(['message' =>'Your record has been deleted.', 'status' => 'fail']);
        }
    }

    public function deletePreviousQualification($id = null)
    {

        try {
            if (!is_null($id)) {
                $previousQualification = UserInfoPreviousQualification::findOrFail($id);
                $previousQualification->delete();

                return response()->json(['message' => 'Your record has been deleted.', 'status' => 'success']);
            } else {
                return response()->json(['message' => 'Your record has been deleted.', 'status' => 'success']);
            }
        } catch (Exception $exception) {

            return response()->json(['message' => 'Your record has been deleted.', 'status' => 'fail']);
        }
    }


    public function addSchoolSubject()
    {
        $schoolSubjects = SchoolSubject::pluck('subject_name', 'id')->all();

        $matricTypes = MatricType::distinct()->select('matric_type')->pluck('matric_type', 'matric_type')->all();

        $html = View::make('pages.account.settings._school-subjects', compact('matricTypes', 'schoolSubjects'))->render();

        return response()->json(['html' => $html]);
    }

    /**
     * Remove the specified academic year from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function deleteSchoolSubject($id = null)
    {

        try {
            if (!is_null($id)) {
                $schoolSubject = UserInfoSchoolSubjects::findOrFail($id);
                $schoolSubject->delete();

                return response()->json(['message' => 'Your record has been deleted.', 'status' => 'success']);
            } else {
                return response()->json(['message' => 'Your record has been deleted.', 'status' => 'success']);
            }
        } catch (Exception $exception) {

            return response()->json(['message' => 'Your record has been deleted.', 'status' => 'fail']);
        }
    }

    public function getMatricTypeGrades($matricType)
    {
        $matricTypes = MatricType::distinct()->select('matric_type', 'grade', 'points')->where('matric_type', $matricType)->get();

        return response()->json($matricTypes);
    }


    public function downloadPreviousQualificationDocument($id, $student_name)
    {
        $previousQualification = UserInfoPreviousQualification::find($id);
        
        return Storage::download($previousQualification->document_path, $student_name."_".$previousQualification->qualification_name);

    }

    public function checkIdNumber(Request $request){

        $student = UserInfo::select('id_number', 'email_address')
                        ->where('id_number', $request->id_passport)
                        ->first();

        if($student){
            if($student->email_address == $request->email){
                return response()->json(['isTaken' => 0]); //Taken by the same student
            } else {
                return response()->json(['isTaken' => 1]); //Taken by a different student
            }
        }

        return response()->json(['isTaken' => 0]); //Not taken at all
    }

}
