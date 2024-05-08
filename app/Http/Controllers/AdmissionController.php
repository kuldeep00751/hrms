<?php

namespace App\Http\Controllers;

use App\Actions\Helper;
use App\Actions\StudentAccount;
use App\Exports\Applications;
use App\Jobs\NotifyUserOfCompletedExport;
use App\Models\AcademicIntake;
use App\Models\AcademicYear;
use App\Models\AdmissionStatus;
use App\Models\Application;
use App\Models\ApplicationHistory;
use App\Models\ApplicationType;
use App\Models\Campus;
use App\Models\CourseFee;
use App\Models\OtherFee;
use App\Models\Qualification;
use App\Models\Registration;
use App\Models\StudentDocument;
use App\Models\StudyMode;
use App\Models\UserInfo;
use Excel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Notification;
use Storage;
use Str;

class AdmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request){

        session()->forget('academic_year');
        session()->forget('academic_intake');
        session()->forget('application_type');
        session()->forget('qualification');
        session()->forget('study_mode');
        session()->forget('campus');
        session()->forget('student_number');
        
        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $applicationTypes = ApplicationType::where('active', 1)->pluck('application_type', 'id')->all();

        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $applications = Application::with('userInfo', 'academicYear', 'academicIntake', 'campus', 'studyMode', 'qualification', 'applicationType')->get();

        $filterData = [];

        return view('pages.admission.applications.index', compact('applications','academicYears', 'academicIntakes', 'applicationTypes', 'qualifications', 'studyModes', 'filterData', 'campuses'));
        
    }

    private function applyFilters($applications, $filterData)
    {

        if (isset($filterData['academic_year'])) {
            $applications = $applications->where('academic_year_id', $filterData[ 'academic_year']);
        }

        if (isset($filterData['academic_intake'])) {
            $applications = $applications->where('academic_intake_id', $filterData[ 'academic_intake']);
        }

        if (isset($filterData['campus'])) {
            $applications = $applications->where('campus_id', $filterData[ 'campus']);
        }

        if (isset($filterData['study_mode'])) {
            $applications = $applications->where('study_mode_id', $filterData[ 'study_mode']);
        }

        if (isset($filterData['qualification'])) {
            $applications = $applications->where('qualification_id', $filterData[ 'qualification']);
        }

        if (isset($filterData['student_number'])) {
            $userInfo = UserInfo::select('id')->where('student_number', $filterData[ 'student_number'])->first();
            
            $applications = $applications->where('user_info_id', $userInfo->id);
        }

        return $applications->get();
    }

    public function filteredApplications(Request $request){

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $applicationTypes = ApplicationType::where('active', 1)->pluck('application_type', 'id')->all();

        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $applications = Application::with('userInfo', 'academicYear', 'academicIntake', 'campus', 'studyMode', 'qualification', 'applicationType');

        $filterData = $this->filterData($request);
        
        $applications = $this->applyFilters($applications, $filterData);

        return view('pages.admission.applications.index', compact('applications', 'academicYears', 'academicIntakes', 'applicationTypes', 'qualifications', 'studyModes', 'filterData', 'campuses'));

    }

    private function filterData($request){
        $academic_year = session()->get('academic_year');
        $academic_intake = session()->get('academic_intake');
        $application_type = session()->get('application_type');
        $qualification = session()->get('qualification');
        $study_mode = session()->get('study_mode');
        $campus = session()->get('campus');
        $student_number = session()->get('student_number');

        if(count($request->all())){

            session()->put('academic_year', $request->academic_year);
            session()->put('academic_intake', $request->academic_intake);
            session()->put('application_type', $request->application_type);
            session()->put('qualification', $request->qualification);
            session()->put('study_mode', $request->study_mode);
            session()->put('campus', $request->campus);
            session()->put('student_number', $request->student_number);

            return $request->all();
        } else {
            return [
                'academic_year' => $academic_year,
                'academic_intake' => $academic_intake,
                'application_type' => $application_type,
                'qualification' => $qualification,
                'study_mode' => $study_mode,
                'campus' => $campus,
                'student_number' => $student_number
            ];
        }
    }

    public function filter(Request $request) {
        
        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $applicationTypes = ApplicationType::where('active', 1)->pluck('application_type', 'id')->all();

        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $applications = Application::with('userInfo', 'academicYear', 'academicIntake', 'campus', 'studyMode', 'qualification', 'applicationType');

        $filterData = $this->filterData($request);

        $applications = $this->applyFilters($applications, $filterData);

        
        return view('pages.admission.applications.index', compact('applications', 'academicYears', 'academicIntakes', 'applicationTypes', 'qualifications', 'studyModes', 'filterData', 'campuses'));
    }

    public function show($id){
        
        $application = Application::with('userInfo', 'admissionStatus', 'qualification', 'campus', 'academicIntake', 'academicYear')->find($id);

        $fullAdmission = ($application->admissionStatus->full_admission ?? 0) ? 1:0;
        
        $userInfo = $application->userinfo;
        
        $applications = Application::where('academic_year_id', $application->academic_year_id)
                                    ->where('user_info_id', $application->user_info_id)
                                    ->get();

        $application_choices = $applications->pluck('choice_number', 'choice_number')->all();
        
        $admission_statuses = AdmissionStatus::where('active', 1)->get();
        
        return view('pages.admission.applications.show', compact('application', 'applications', 'admission_statuses', 'application_choices', 'userInfo', 'fullAdmission'));
    }

    public function store(Request $request, Helper $helper){
        
        try {
            $application = Application::find($request->application_id);

            $isAdmissionOpen = $helper->isAdmissionProcessOpen($application->academic_year_id, $application->academic_intake_id);

            if(!$isAdmissionOpen){
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'The Admission academic process is closed.']);
            }

            // $isSettingFullAdmission = $this->isSettingFullAdmission($request, $application);
            
            // if($isSettingFullAdmission)
            // {
            //     return back()->withInput()
            //     ->withErrors(['unexpected_error' => 'This student has already been granted full admission on one of the choices.']);
            // }

            $data = $this->getData($request);
            
            ApplicationHistory::create($data);

            $application->application_status = $this->getNewApplicationStatus($request->admission_status_id);
            $application->application_status_id = $request->admission_status_id;
            
            $application->save();
           
            
            return redirect()->route('admission.application.show', $request->application_id)
                ->with('success_message', 'Application processed successfully.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function registerStudent(Request $request, Helper $helper, StudentAccount $studentAccount){

        $application = Application::find($request->application_id);

        if (!isset($application->userInfo->student_number)) {
            $academicYear = AcademicYear::find($application->academic_year_id);

            $student_number = $this->generateStudentNumber($academicYear->name);

            $application->userInfo->student_number = $student_number;

            $application->userInfo->save();
        }

        $registration = Registration::where('application_id', $request->application_id)->first();

        if($registration){
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Student already registered for the course.']);
        }

        $isRegistrationProcessOpen = $helper->isRegistrationProcessOpen($application->academic_year_id, $application->academic_intake_id);

        if (!$isRegistrationProcessOpen) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'The Registration academic process is closed.']);
        }

        try {

            $registration;

            DB::transaction(function () use ($helper, $studentAccount, $application, &$registration) {
                $yearLevel = 1;

                $studentTypeId = $application->userInfo->citizenship_status;

                $fees = OtherFee::with('feeType')->where('academic_process', 'Registration')
                    ->where('academic_year_id', $application->academic_year_id)
                    ->where('student_type_id', $studentTypeId)
                    ->where('qualification_id', $application->qualification_id)
                    ->where('year_level_id', $yearLevel)
                    ->get();
                
                $studentAccount->chargeExtraFees($fees, $application->user_info_id);

                $courseChargeType = $helper->getListOfValue('REGISTRATION_FEE_CHARGE_TYPE');

                if ($courseChargeType === 'Qualification') {
                    $courseFee = CourseFee::with('qualification')
                        ->where('academic_process', 'Registration')
                        ->where('academic_year_id', $application->academic_year_id)
                        ->where('student_type_id', $studentTypeId)
                        ->where('qualification_id', $application->qualification_id)
                        ->where('year_level_id', $yearLevel)
                        ->first();

                    if (!$courseFee) {
                        return back()->withInput()
                            ->withErrors(['unexpected_error' => 'No course fee defined']);
                    }

                    $studentAccount->chargeCourseFee($courseFee, $application->user_info_id);
                }

                $registration = $this->createStudentRegistrationRecord($application);
            });

            return redirect()->route('registration.module.show', $registration->id);

        } catch (Exception $exception) {

            Log::critical($exception);

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }

    }

    private function createStudentRegistrationRecord($application)
    {
        return Registration::create([
            'user_info_id' => $application->user_info_id,
            'application_id' => $application->id,
            'qualification_id' => $application->qualification_id,
            'study_mode_id' => $application->study_mode_id,
            'campus_id' => $application->campus_id,
            'year_level_id' => 1,
            'academic_year_id' => $application->academic_year_id,
            'academic_intake_id' => $application->academic_intake_id,
            'choice_number' => $application->choice_number,
            'registration_status_id' => 1,
            'promotion_status' => 0,
            'created_by' => auth()->user()->id,
        ]);
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


    private function getNewApplicationStatus($admission_status_id){
        $admissionStatus = AdmissionStatus::find($admission_status_id);

        return $admissionStatus->status;
    }

    private function isSettingFullAdmission($request, $application){
        $admissionStatus = AdmissionStatus::find($request->admission_status_id);

        if ($admissionStatus->full_admission == 1){

                $currentApplicationStatuses = Application::where('user_info_id', $application->user_info_id)
                    ->where('academic_year_id', $application->academic_year_id)
                    ->pluck('application_status_id');

                $fullAdmissionStatuses = AdmissionStatus::select('full_admission')
                    ->whereIn('id', $currentApplicationStatuses)
                    ->pluck('full_admission')
                    ->toArray();

                if (count($fullAdmissionStatuses) > 0) {
                    return (in_array("1", $fullAdmissionStatuses)) ? true : false;
            } else {
                return false;
            }
        }
    }

    public function export(Request $request)
    {
        $campus = Campus::select('name')->where('id', $request->campus)->first()->name;

        $qualification = Qualification::select('qualification_name')->where('id', $request->qualification)->first()->qualification_name;

        $fileName = Str::slug($campus.'_'. $qualification, "_");

        $fileName = 'applications_' . $fileName . '_'.time() .'.xlsx';

        $filePath = storage_path('app/public/'. $fileName);

       (new Applications($request->all()))->store($fileName)->chain([
            new NotifyUserOfCompletedExport(request()->user(), $filePath),
        ]);

        
        //return back()->withSuccess('Export started!');

        //return Excel::download(new Applications($request->all()), 'applications_'.date('Y-m-d').'.xlsx');
    }

    public function downloadExcel($id)
    {
        $user = request()->user();

        $latest = $user->unreadNotifications->first();

        $file = $latest->data['file_path'];

        $latest->markAsRead();
        
        return Storage::download(basename($file));
    }

    public function download($id){
        $document = StudentDocument::find($id);
        
        return Storage::download($document->document_path, $document->userInfo->student_number."_".$document->requiredDocument->document_name.".pdf");

    }

    public function displayDocument($id)
    {
        $document = StudentDocument::find($id);

        if (!Storage::exists($document->document_path)) {
            abort(404, 'The file does not exist.');
        }

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="example.pdf"',
        ];

        return response()->file(storage_path('app').'/'.$document->document_path, $headers);
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
            'admission_status_id' => 'required',
            'remark' => 'nullable',
            'application_id' => 'required',
            'user_id' => 'required',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
