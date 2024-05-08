<?php

namespace App\Http\Controllers;

use App\Actions\Helper;
use App\Actions\StudentAccount;
use App\Models\AcademicIntake;
use App\Models\AcademicYear;
use App\Models\AdmissionStatus;
use App\Models\Application;
use App\Models\ApplicationType;
use App\Models\CaMarkTypes;
use App\Models\Campus;
use App\Models\CourseFee;
use App\Models\ModuleCancellationPolicy;
use App\Models\ModuleRegistration;
use App\Models\OtherFee;
use App\Models\PromotionStatus;
use App\Models\Qualification;
use App\Models\Registration;
use App\Models\RegistrationStatus;
use App\Models\StudyMode;
use App\Models\SubjectFee;
use App\Models\UserInfo;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $registrations = Registration::with('userInfo', 'academicYear', 'academicIntake', 'campus', 'studyMode', 'qualification', 'yearLevel', 'promotionStatus')->get();

        
        return view('pages.registration.qualification.index', compact('registrations'));
    }

    private function applyFilters($applications, $filterData)
    {

        if (isset($filterData['academic_year'])) {
            $applications = $applications->where('academic_year_id', $filterData['academic_year']);
        }

        if (isset($filterData['academic_intake'])) {
            $applications = $applications->where('academic_intake_id', $filterData['academic_intake']);
        }

        if (isset($filterData['campus'])) {
            $applications = $applications->where('campus_id', $filterData['campus']);
        }

        if (isset($filterData['study_mode'])) {
            $applications = $applications->where('study_mode_id', $filterData['study_mode']);
        }

        if (isset($filterData['qualification'])) {
            $applications = $applications->where('qualification_id', $filterData['qualification']);
        }

        if (isset($filterData['student_number'])) {
            $userInfo = UserInfo::select('id')->where('student_number', $filterData['student_number'])->first();

            $applications = $applications->where('user_info_id', $userInfo->id);
        }

        return $applications->get();
    }

    public function filteredApplications(Request $request)
    {

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $applicationTypes = ApplicationType::where('active', 1)->pluck('application_type', 'id')->all();

        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $fullAdmissionStatuses = AdmissionStatus::where('full_admission', 1)->pluck('id');

        $applications = Application::with('userInfo', 'academicYear', 'academicIntake', 'campus', 'studyMode', 'qualification', 'applicationType')
                                ->whereIn('application_status_id', $fullAdmissionStatuses);

        $filterData = $this->filterData($request);

        $applications = $this->applyFilters($applications, $filterData);

        return view('pages.admission.applications.index', compact('applications', 'academicYears', 'academicIntakes', 'applicationTypes', 'qualifications', 'studyModes', 'filterData', 'campuses'));
    }

    private function filterData($request)
    {
        $academic_year = session()->get('academic_year');
        $academic_intake = session()->get('academic_intake');
        $application_type = session()->get('application_type');
        $qualification = session()->get('qualification');
        $study_mode = session()->get('study_mode');
        $campus = session()->get('campus');
        $student_number = session()->get('student_number');

        if (count($request->all())) {

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

    public function filter(Request $request)
    {

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $applicationTypes = ApplicationType::where('active', 1)->pluck('application_type', 'id')->all();

        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $fullAdmissionStatuses = AdmissionStatus::where('full_admission', 1)->pluck('id');

        $applications = Application::whereIn('application_status_id', $fullAdmissionStatuses);

        $pendingRegistrations = Registration::where('registration_status_id', 3)->get();

        $filterData = $this->filterData($request);

        $applications = $this->applyFilters($applications, $filterData);

        $applications = $applications->merge($pendingRegistrations);

        return view('pages.registration.qualification.index', compact('applications', 'academicYears', 'academicIntakes', 'applicationTypes', 'qualifications', 'studyModes', 'filterData', 'campuses'));
    }

    public function edit(Registration $registration){

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $qualifications = Qualification::where('active', 1)->pluck('qualification_name', 'id')->all();

        $studyModes = StudyMode::where('active', 1)->pluck('study_mode', 'id')->all();

        $campuses = Campus::where('active', 1)->pluck('name', 'id')->all();

        return view('pages.registration.qualification.edit', compact('registration', 'academicIntakes', 'qualifications', 'studyModes', 'campuses'));
    }

    public function update(Request $request, Registration $registration){
        try {

            ModuleRegistration::where('user_info_id', $registration->user_info_id)
            ->where('academic_year_id', $registration->academic_year_id)
            ->where('study_mode_id', $registration->study_mode_id)
            ->where('academic_intake_id', $registration->academic_intake_id)
            ->where('academic_year_id', $registration->academic_year_id)
            ->where('campus_id', $registration->campus_id)
                ->update([
                    'campus_id' => $request->campus_id,
                    'study_mode_id' => $request->study_mode_id,
                    'academic_intake_id' => $request->academic_intake_id
                ]);

            $registration->update([
                'campus_id' => $request->campus_id,
                'study_mode_id' => $request->study_mode_id,
                'academic_intake_id' => $request->academic_intake_id
            ]);

            return redirect()->route('qualification.qualification-management')
                ->with('success_message', 'Student Registratop Qualification successfully updated');

        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function show($id)
    {
        $registration = Registration::with('userInfo', 'academicYear', 'academicIntake', 'campus', 'studyMode', 'qualification', 'yearLevel', 'promotionStatus')->find($id);
        
        return view('pages.registration.qualification.show', compact('registration'));
    }

    public function store(Request $request, Helper $helper, StudentAccount $studentAccount)
    {

        $registration = Registration::with('userInfo')
                    ->where('id', $request->registration_id)
                    ->first();

        
        if(!$registration->promotion_status){

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'This student has not been promoted. Please promote the student before registering for the year']);
        } else {

            $promotionStatus = PromotionStatus::find($registration->promotion_status);

            $isFinalYear = $this->isFinalYear($registration);

            if(($promotionStatus->promoted) && ($isFinalYear)){
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'This student has passed the final year.']);
            }
        }

        $currentAcademicYear = AcademicYear::find($registration->academic_year_id)->name;

        $nextAcademicYearName = intval($currentAcademicYear) + 1;

        $nextAcademicYear = AcademicYear::where('name', $nextAcademicYearName)->first();

        if(!$nextAcademicYear){
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Academic year not defined. Please define the academic year under settings.']);
        }

        $nextRegistration = Registration::where('academic_year_id', $nextAcademicYear->id)
                                        ->where('user_info_id', $registration->user_info_id)
                                        ->first();
        
        if($nextRegistration){
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Student already registered.']);
        }
        
      
        $isRegistrationProcessOpen = $helper->isRegistrationProcessOpen($nextAcademicYear->id, $registration->academic_intake_id);
        
        if (!$isRegistrationProcessOpen) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'The Registration academic process is closed.']);
        }
        
        try {

            if ($promotionStatus->promoted) {
                $yearLevel = intval($registration->yearLevel->year_level) + 1;
            } else {
                $yearLevel = intval($registration->yearLevel->year_level);
            }
            
            $newRegistration;

            DB::transaction(function () use ($helper, $studentAccount, $nextAcademicYear, $yearLevel, $registration, &$newRegistration) {
                
                $studentTypeId = $registration->userInfo->citizenship_status;

                $fees = OtherFee::with('feeType')->where('academic_process', 'Registration')
                    ->where('academic_year_id', $nextAcademicYear->id)
                    ->where('student_type_id', $studentTypeId)
                    ->where('qualification_id', $registration->qualification_id)
                    ->where('year_level_id', $yearLevel)
                    ->get();
            
                $studentAccount->chargeExtraFees($fees, $registration->user_info_id);
                
                $courseChargeType = $helper->getListOfValue('REGISTRATION_FEE_CHARGE_TYPE');
                
                if ($courseChargeType === 'Qualification') {
                    $courseFee = CourseFee::with('qualification')
                        ->where('academic_process', 'Registration')
                        ->where('academic_year_id', $registration->academic_year_id)
                        ->where('student_type_id', $studentTypeId)
                        ->where('qualification_id', $registration->qualification_id)
                        ->where('year_level_id', $yearLevel)
                        ->first();

                    if (!$courseFee) {
                        return back()->withInput()
                            ->withErrors(['unexpected_error' => 'No course fee defined']);
                    }

                    $studentAccount->chargeCourseFee($courseFee, $registration->user_info_id);
                }

                $newRegistration = $this->createStudentRegistrationRecord($registration, $nextAcademicYear->id, $yearLevel);
                
            });
            
            return redirect()->route('registration.module.show', $newRegistration->id);
            

        } catch (Exception $exception) {
            
            Log::critical($exception);
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    private function createStudentRegistrationRecord($studentRegistration, $academicYearId, $yearLevel)
    {
        return Registration::create([
            'user_info_id' => $studentRegistration->user_info_id,
            'application_id' => $studentRegistration->application_id,
            'qualification_id' => $studentRegistration->qualification_id,
            'study_mode_id' => $studentRegistration->study_mode_id,
            'campus_id' => $studentRegistration->campus_id,
            'year_level_id' => $yearLevel,
            'academic_year_id' => $academicYearId,
            'academic_intake_id' => $studentRegistration->academic_intake_id,
            'choice_number' => $studentRegistration->choice_number,
            'registration_status_id' => 1,
            'promotion_status' => 0,
            'created_by' => auth()->user()->id,
        ]);
    }

    private function isFinalYear($studentRegistration)
    {
        $number_of_years = intval($studentRegistration->qualification->number_of_years);

        $new_year_level = intval($studentRegistration->yearLevel->year_level) + 1;

        if ($new_year_level > $number_of_years) {
            return true;
        } else {
            return false;
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

    public function qualificationMangementView(Request $request){
        
        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $userInfo = UserInfo::select('id')->where('student_number', $request->student_number)->first();
        
        $qualificationRegistration = [];

        if ($userInfo) {

            $qualificationRegistration = Registration::where('user_info_id', $userInfo->id)
                                                    ->where('academic_year_id', $request->academic_year_id)
                                                    ->get();
                                                    
        }

        $filterData = $request->except('_token');

        return view('pages.registration.qualification.qualification-management', compact('academicYears', 'qualificationRegistration', 'filterData'));
    }

    public function cancelQualification(Request $request, Helper $helper, StudentAccount $studentAccount){

        $qualificationRegistration = Registration::where('id',$request->registration_id)
                                                ->where('is_cancelled', 0)
                                                ->first();
        
        if(!$qualificationRegistration){
            return response()->json([
                'status' => 0,
                'message' => 'Qualification has already been cancelled.',
            ]);
        }

        $courseChargeType = $helper->getListOfValue('REGISTRATION_FEE_CHARGE_TYPE');
        
        $moduleRegistrations = ModuleRegistration::with('module')
                                                ->where('academic_year_id', $qualificationRegistration->academic_year_id)
                                                ->where('user_info_id', $qualificationRegistration->user_info_id)
                                                ->where('is_cancelled', 0)
                                                ->get();
        if(count($moduleRegistrations)){
            
            $qualificationCancellationPolicy = $this->getQualificationCancellationPolicy($qualificationRegistration, $request);
            
            if (!$qualificationCancellationPolicy) {
                return response()->json([
                    'status' => 0,
                    'message' => 'There was a problem cancelling this qualification, please define the cancellation policy.',
                ]);
            }

            $isCancellationProcessOpen = $helper->isCancellationProcessOpen($qualificationRegistration->academic_year_id, $qualificationRegistration->academic_intake_id);
            
            if (!$isCancellationProcessOpen) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Error while processing cancellatoin. The cancellation process is closed.',
                ]);
            }

            $moduleCancellationPolicies = $this->getCancelationPercentage($moduleRegistrations, $request);

            if (!count($moduleCancellationPolicies)) {
                return response()->json([
                    'status' => 0,
                    'message' => 'There was a problem cancelling this qualification, please define the cancellation policy for the academic year, intake, and study period combination.',
                ]);
            }

            $moduleAssessments = $this->moduleHasAssessments($moduleRegistrations);

            $moduleFees = $this->getModuleFees($moduleRegistrations, $helper);

            
            foreach($moduleRegistrations as $moduleRegistration){

                $moduleAssessment = $moduleAssessments->where('module_id', $moduleRegistration->module_id)->first();
                
                if ($moduleAssessment) {

                    return response()->json([
                        'status' => 0,
                        'message' => 'Error while processing cancellation. Assessments have already been captured for '.$moduleRegistration->module->module_name,
                    ]);
                }

                $cancellationPercentage = 0;

                $moduleCancellationPolicy = $moduleCancellationPolicies->where('academic_intake_id', $moduleRegistration->academic_intake_id)
                                                                        ->where('study_period_id', $moduleRegistration->study_period_id)
                                                                        ->first();
                if ($moduleCancellationPolicy) {
                    $cancellationPercentage = $moduleCancellationPolicy->cancellation_percentage;
                } else {

                    return response()->json([
                        'status' => 0,
                        'message' => 'There was a problem cancelling this qualification, please define the cancellation policy for '.$moduleRegistration->module->module_name.' for the academic year, intake, and study period combination.',
                    ]);
                }


                if($courseChargeType === 'Subject'){

                    $moduleFee = $moduleFees->where('module_id', $moduleRegistration->module_id)
                                            ->first();

                    if($moduleFee){
                        $studentAccount->creditStudentCancellationModule($moduleRegistration, $cancellationPercentage, $moduleFee, "Cancelation");

                        $moduleRegistration->is_cancelled = 1;
                        $moduleRegistration->registration_status_id = 2;
                        $moduleRegistration->cancel_date = date('Y-m-d h:i:s');
                        $moduleRegistration->updated_by = auth()->user()->id;
                        $moduleRegistration->cancel_reason = $request->cancellation_reason;
                        $moduleRegistration->save();

                    } else {
                        return response()->json([
                            'status' => 0,
                            'message' => 'There was a problem cancelling this qualification, please define the module fees for ' . $moduleRegistration->module->module_name . ' for the academic year, intake, and exam type combination.',
                        ]);
                    }

                }
                
            }

            if ($courseChargeType === 'Qualification') {
                $qualificationFee = $this->getQualificationFee($qualificationRegistration, $helper);

                if (!$qualificationFee) {
                    return response()->json([
                        'status' => 0,
                        'message' => 'There was a problem cancelling this qualification, please define the qualification fee',
                    ]);
                }
                $cancellationPercentage = $qualificationCancellationPolicy->cancellation_percentage;

                $studentAccount->creditStudentCancellationQualification($qualificationRegistration, $cancellationPercentage, $qualificationFee);
            }
        }

        $qualificationRegistration->is_cancelled = 1;
        $qualificationRegistration->registration_status_id = 2;
        $qualificationRegistration->cancellation_reason = $request->cancellation_reason;
        $qualificationRegistration->cancellation_date = $request->cancellation_date;
        $qualificationRegistration->save();

        $registrationStatus = RegistrationStatus::find(2);

        return response()->json([
            'status' => 1,
            'moduleRegistrationId' => $request->registration_id,
            'registrationStatus' => $registrationStatus->status,
            'message' => 'Qualification successfully cancelled. Please check if correct credits have been applied.',
        ]);

    }

    private function getQualificationCancellationPolicy($qualificationRegistration, $request){

        $policy = ModuleCancellationPolicy::where('date_from', '<=', $request->cancellation_date)
                                        ->where('date_to', '>=', $request->cancellation_date)
                                        ->where('academic_year_id', $qualificationRegistration->academic_year_id)
                                        ->where('academic_intake_id', $qualificationRegistration->academic_intake_id)
                                        ->first();
        return $policy;
    }

    private function getQualificationFee($qualificationRegistration, $helper){

        return CourseFee::where('qualification_id', $qualificationRegistration->qualification_id)
                        ->where('academic_year_id', $qualificationRegistration->academic_year_id)
                        ->where('student_type_id', $helper->getStudentTypeId($qualificationRegistration->userInfo))
                        ->first();
    }

    private function moduleHasAssessments($moduleRegistrations)
    {
        
        return CaMarkTypes::whereIn('module_id', $moduleRegistrations->pluck('module_id'))
            ->where('academic_year_id', $moduleRegistrations->first()->academic_year_id)
            ->where('user_info_id', $moduleRegistrations->first()->user_info_id)
            ->get();

    }

    private function getModuleFees($moduleRegistration, $helper)
    {
        
        $subjectFees = SubjectFee::whereIn('module_id', $moduleRegistration->pluck('module_id'))
            ->where('academic_year_id', $moduleRegistration->first()->academic_year_id)
            ->where('assessment_type_id', $moduleRegistration->first()->assessment_type_id)
            ->where('active', 1)
            ->where('student_type_id', $moduleRegistration->first()->userInfo->citizenship_status)
            ->get();

        return $subjectFees;
    }

    private function getCancelationPercentage($moduleRegistrations, $request)
    {
        $moduleCancellationPolicy = ModuleCancellationPolicy::where('date_from', '<=', $request->cancellation_date)
                                                            ->where('date_to', '>=', $request->cancellation_date)
                                                            ->where('academic_year_id', $moduleRegistrations->first()->academic_year_id)
                                                            ->whereIn('academic_intake_id', $moduleRegistrations->pluck('academic_intake_id'))
                                                            ->whereIn('study_period_id', $moduleRegistrations->pluck('study_period_id'))
                                                            ->get();
        return $moduleCancellationPolicy;
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
            'application_id' => 'required',
            'created_by' => 'required',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
