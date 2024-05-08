<?php

namespace App\Http\Controllers;

use App\Actions\Helper;
use App\Actions\StudentAccount;
use App\DataTables\ModuleRegistrationDataTable;
use App\Models\AcademicIntake;
use App\Models\AcademicYear;
use App\Models\ApplicationType;
use App\Models\AssessmentType;
use App\Models\CaMarkTypes;
use App\Models\ModuleRegistration;
use App\Models\Qualification;
use App\Models\Registration;
use App\Models\StudyMode;
use App\Models\Campus;
use App\Models\Module;
use App\Models\ModuleCancellationPolicy;
use App\Models\OtherFee;
use App\Models\RegistrationStatus;
use App\Models\SubjectFee;
use App\Models\StudentAccount as Account;
use App\Models\StudentSubjectDetail;
use App\Models\StudyPeriod;
use App\Models\UserInfo;
use Exception;
use View;
use Illuminate\Http\Request;

class ModuleRegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the education systems.
     *
     * @return Illuminate\View\View
     */
    public function index(ModuleRegistrationDataTable $dataTable)
    {

        return $dataTable->render('pages.registration.modules.index');

    }

    private function applyFilters($qualificationRegistrations, $filterData)
    {

        if (isset($filterData['academic_year'])) {
            $qualificationRegistrations = $qualificationRegistrations->where('academic_year_id', $filterData['academic_year']);
        }

        if (isset($filterData['academic_intake'])) {
            $qualificationRegistrations = $qualificationRegistrations->where('academic_intake_id', $filterData['academic_intake']);
        }

        if (isset($filterData['campus'])) {
            $qualificationRegistrations = $qualificationRegistrations->where('campus_id', $filterData['campus']);
        }

        if (isset($filterData['study_mode'])) {
            $qualificationRegistrations = $qualificationRegistrations->where('study_mode_id', $filterData['study_mode']);
        }

        if (isset($filterData['qualification'])) {
            $qualificationRegistrations = $qualificationRegistrations->where('qualification_id', $filterData['qualification']);
        }

        if (isset($filterData['student_number'])) {
            $userInfo = UserInfo::select('id')->where('student_number', $filterData['student_number'])->first();

            $qualificationRegistrations = $qualificationRegistrations->where('user_info_id', $userInfo->id);
        }

        return $qualificationRegistrations->get();
    }

    public function filteredRegistrations(Request $request)
    {

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $applicationTypes = ApplicationType::where('active', 1)->pluck('application_type', 'id')->all();

        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $applications = Registration::with('userInfo', 'academicYear', 'academicIntake', 'campus', 'studyMode', 'qualification');

        $filterData = $this->filterData($request);

        $applications = $this->applyFilters($applications, $filterData);

        return view('pages.registration.modules.index', compact('applications', 'academicYears', 'academicIntakes', 'applicationTypes', 'qualifications', 'studyModes', 'filterData', 'campuses'));
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

        $qualificationRegistrations = Registration::with('userInfo', 'academicYear', 'academicIntake', 'campus', 'studyMode', 'qualification');

        $filterData = $this->filterData($request);

        $qualificationRegistrations = $this->applyFilters($qualificationRegistrations, $filterData);


        return view('pages.registration.modules.index', compact('qualificationRegistrations', 'academicYears', 'academicIntakes', 'applicationTypes', 'qualifications', 'studyModes', 'filterData', 'campuses'));
    }

    public function filteredApplications(Request $request)
    {

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $applicationTypes = ApplicationType::where('active', 1)->pluck('application_type', 'id')->all();

        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $qualificationRegistrations = Registration::with('userInfo', 'academicYear', 'academicIntake', 'campus', 'studyMode', 'qualification');

        $filterData = $this->filterData($request);

        $qualificationRegistrations = $this->applyFilters($qualificationRegistrations, $filterData);

        return view('pages.registration.modules.index', compact('qualificationRegistrations', 'academicYears', 'academicIntakes', 'applicationTypes', 'qualifications', 'studyModes', 'filterData', 'campuses'));
    }

    private function moduleCountPerQualification($qualificationRegistrations){
        
        return ModuleRegistration::selectRaw('count(module_id) as count, user_info_id')
                                    ->whereIn('academic_year_id', $qualificationRegistrations->pluck('academic_year_id', 'academic_year_id'))
                                     ->whereIn('study_mode_id', $qualificationRegistrations->pluck('study_mode_id', 'study_mode_id'))
                                     ->whereIn('academic_intake_id', $qualificationRegistrations->pluck('academic_intake_id', 'academic_intake_id'))
                                     ->whereIn('campus_id', $qualificationRegistrations->pluck('campus_id', 'campus_id'))
                                     ->where('is_cancelled', 0)
                                     ->groupBy('user_info_id')
                                     ->get();

        
    }

    public function show($id)
    {

        $registration = Registration::with('userInfo', 'qualification', 'application', 'qualification')->find($id);

        $failedModulesArray = StudentSubjectDetail::select('module_id')
                                            ->where('user_info_id', $registration->user_info_id)
                                            ->where(function ($query){
                                                $query->where('pass_fail', 'F')
                                                        ->orWhereNull('result_code');
                                            })
                                            ->pluck('module_id', 'module_id');
        
        $passedModulesArray = StudentSubjectDetail::select('module_id')
            ->where('user_info_id', $registration->user_info_id)
            ->where(function ($query) {
                $query->where('pass_fail', 'P');
            })
            ->pluck('module_id', 'module_id');
        
        $modules = $registration->qualification
            ->modules
            ->where('module_level_id', $registration->qualification->qualification_type_id)
            ->where('year_level_id', '=', $registration->year_level_id);
            //->whereNotIn('id', $passedModulesArray->toArray());
                                     
        $failedModules = Module::whereIn('id', $failedModulesArray)->get();

        $modules = $modules->merge($failedModules);

        $moduleRegistration = ModuleRegistration::with('registrationStatus', 'studyMode', 'studyPeriod')
                                                    ->select('module_id', 'study_period_id', 'study_mode_id', 'registration_status_id')
                                                    ->where('academic_year_id', $registration->academic_year_id)
                                                    ->where('user_info_id', $registration->user_info_id)
                                                    ->get();
                                                    
        
        return view('pages.registration.modules.show', compact('registration', 'modules', 'moduleRegistration'));
    }

    public function addModule($userInfoId, $academicYearId){

        $userInfo = UserInfo::find($userInfoId);

        $modules = Module::where('active', 1)->selectRaw('concat(module_name, concat(" (", concat(module_code, ")"))) as module, id')->orderBy('module')->pluck('module', 'id')->all();

        $qualifications = Registration::where('user_info_id', $userInfoId)
                                        ->where('academic_year_id', $academicYearId)
                                        ->join('qualifications', 'qualifications.id', '=', 'registrations.qualification_id')
                                        ->pluck('qualifications.qualification_name', 'qualifications.id')
                                        ->all();

        $academicYear = AcademicYear::find($academicYearId);

        $academicIntakes = AcademicIntake::pluck('name', 'id')->all();

        $studyModes = StudyMode::where('active', 1)->pluck('study_mode', 'id')->all();

        $studyPeriods = StudyPeriod::where('active', 1)->pluck('study_period', 'id')->all();

        return view('pages.registration.modules.add', compact('userInfo', 'modules', 'academicYear', 'academicIntakes', 'studyModes', 'studyPeriods', 'qualifications'));
    }

    public function registerModule(Request $request, Helper $helper, StudentAccount $studentAccount){
       
        $isAcademicProcessOpen = $helper->isRegistrationProcessOpen($request->academic_year_id, $request->academic_intake_id);

        if(!$isAcademicProcessOpen){
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'The Registration academic process is closed.']);
            
        }

        $isModuleRegistered = $this->getModuleRegistration($request->user_info_id, $request->module_id, $request->academic_year_id, $request->academic_intake_id);
        
        if ($isModuleRegistered) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'The module is already registered for this academic year and intake.']);
        }

        try {

            $registration = Registration::with('userInfo')
                ->where('academic_year_id', $request->academic_year_id)
                ->where('user_info_id', $request->user_info_id)
                ->where('qualification_id', $request->qualification_id)
                ->first();

            $assessmentType = AssessmentType::where('default', 1)->first();

            $userInfo = UserInfo::find($request->user_info_id);

            $subjectFee = SubjectFee::with('module')
                ->where('academic_process', 'Registration')
                ->where('academic_year_id', $request->academic_year_id)
                ->where('student_type_id', $userInfo->citizenship_status)
                ->where('module_id', $request->module_id)
                ->get();


            if (!$subjectFee) {
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'No subject fees defined.']);
            }

            $studentAccount->chargeModuleFees($subjectFee, $request->user_info_id);

            ModuleRegistration::create([
                'user_info_id' => $request->user_info_id,
                'qualification_id' => $registration->qualification_id,
                'module_id' => $request->module_id,
                'academic_year_id' => $request->academic_year_id,
                'campus_id' => $registration->campus_id,
                'assessment_type_id' => $assessmentType->id,
                'academic_intake_id' => $request->academic_intake_id,
                'student_year_level' => $registration->year_level_id,
                'study_mode_id'  => $request->study_mode_id,
                'study_period_id' => $request->study_period_id,
                'created_by' => auth()->user()->id
            ]);
    

            return redirect()->back()
            ->with('success_message', 'Module registration successful.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    private function getModuleRegistration($userInfoId, $moduleId, $academicYearId, $academicIntakeId){
        return ModuleRegistration::where('module_id', $moduleId)
                                    ->where('user_info_id', $userInfoId)
                                    ->where('academic_year_id', $academicYearId)
                                    ->where('academic_intake_id', $academicIntakeId)
                                    ->first();

    }

    public function store(Request $request, Helper $helper, StudentAccount $studentAccount)
    {
        $data = $this->getData($request);
        
        $registration = Registration::with('userInfo')
                                    ->where('id', $request->registration_id)
                                    ->first();
        
        $isRegistrationProcessOpen = $helper->isRegistrationProcessOpen($registration->academic_year_id, $registration->academic_intake_id);

        if (!$isRegistrationProcessOpen) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'The Registration academic process is closed.']);
        }

        try {

            $moduleChargeType = $helper->getListOfValue('REGISTRATION_FEE_CHARGE_TYPE');

            $assessmentType = AssessmentType::where('default', 1)->first();

            $modules = Module::whereIn('id', $data['module_id'])->get();
            
            if ($moduleChargeType === 'Subject') {

                $subjectFees = SubjectFee::with('module')
                                        ->where('academic_process', 'Registration')
                                        ->where('academic_year_id', $registration->academic_year_id)
                                        ->where('student_type_id', $registration->userInfo->citizenship_status)
                                        ->whereIn('module_id', $data['module_id'])
                                        ->get();
                
                if (!count($subjectFees)) {
                    return back()->withInput()
                        ->withErrors(['unexpected_error' => 'No subject fees defined.']);
                }

                $moduleFeeDefined = $this->CheckIfModuleFeeDefined($data['module_id'], $subjectFees);
                
                if($moduleFeeDefined['defined']){
                    
                    $studentAccount->chargeModuleFees($subjectFees, $registration->user_info_id);

                    foreach($request->module_id as $key => $value){
                        
                        ModuleRegistration::create([
                            'user_info_id' => $registration->user_info_id,
                            'qualification_id' => $registration->qualification_id,
                            'module_id' => $value,
                            'academic_year_id' => $registration->academic_year_id,
                            'campus_id' => $registration->campus_id,
                            'assessment_type_id' => $assessmentType->id,
                            'academic_intake_id' => $registration->academic_intake_id,
                            'student_year_level' => $registration->year_level_id,
                            'study_mode_id'  => $data['study_mode_id'][$value],
                            'study_period_id' => $data['study_period_id'][$value],
                            'created_by' => auth()->user()->id
                        ]);
                    }
                } else {
                    return back()->withInput()
                        ->withErrors(['unexpected_error' => 'Subject fees for '. $modules->find($moduleFeeDefined['module_id'])->module_name.'('. $modules->find($moduleFeeDefined['module_id'])->module_code.') not defined']);
                }
                
            } else {
                foreach ($request->module_id as $key => $value) {

                    ModuleRegistration::create([
                        'user_info_id' => $registration->user_info_id,
                        'module_id' => $value,
                        'qualification_id' => $registration->qualification_id,
                        'academic_year_id' => $registration->academic_year_id,
                        'campus_id' => $registration->campus_id,
                        'assessment_type_id' => $assessmentType->id,
                        'academic_intake_id' => $registration->academic_intake_id,
                        'student_year_level' => $registration->year_level_id,
                        'study_mode_id'  => $data['study_mode_id'][$value],
                        'study_period_id' => $data['study_period_id'][$value],
                        'created_by' => auth()->user()->id
                    ]);
                }
            }
            
            return redirect()->route('registration.module.show', $data['registration_id'])
                ->with('success_message', 'Student successfully registered for the modules below.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function moduleMangementView(Request $request){

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $userInfo = UserInfo::select('id')->where('student_number', $request->student_number)->first();

        $moduleRegistration = [];

        if($userInfo){
        
            $moduleRegistration = ModuleRegistration::where('user_info_id', $userInfo->id)
                                                        ->where('academic_year_id', $request->academic_year_id)
                                                        ->get();
        }


        $filterData = $request->except('_token');

        return view('pages.registration.modules.module-management', compact('academicYears', 'moduleRegistration', 'filterData'));
    }

    public function cancelModule(Request $request, Helper $helper, StudentAccount $studentAccount)
    {
        $moduleRegistration = ModuleRegistration::with('module')->find($request->module_registration_id);
        
        if($this->moduleHasAssessments($moduleRegistration)){
            
            return response()->json([
                'status' => 0,
                'message' => 'Error while cancelling module. Assessments have already been captured.',
            ]);
            
        }

        if ($moduleRegistration->is_cancelled == 1) {

            return response()->json([
                'status' => 0,
                'message' => 'Error while cancelling module. This module has already been cancelled.',
            ]);
        }
        
        if($helper->isCancellationProcessOpen($moduleRegistration->academic_year_id, $moduleRegistration->academic_intake_id)){

            $moduleCancellationPolicy = $this->getCancelationPercentage($moduleRegistration, $request);
            
            $cancellationPercentage = 0;

            if($moduleCancellationPolicy){
                $cancellationPercentage = $moduleCancellationPolicy->cancellation_percentage;
            } else {

                return response()->json([
                    'status' => 0,
                    'message' => 'There was a problem cancelling this module, please define the cancellation policy for this module\'s academic year, intake, and study period.',
                ]);
            }

            $moduleFee = $this->getModuleFee($moduleRegistration, $helper);

            if (!$moduleFee) {
                return response()->json([
                    'status' => 0,
                    'message' => 'There was a problem cancelling this module, Please define the module fee for the correct assessment type.',
                ]);
            }

            $moduleRegistration->is_cancelled = 1;
            $moduleRegistration->registration_status_id = 2;
            $moduleRegistration->cancel_date = $request->cancellation_date;
            $moduleRegistration->updated_by = auth()->user()->id;
            $moduleRegistration->cancel_reason = $request->cancellation_reason;
            $moduleRegistration->save();

            $studentAccount->creditStudentCancellationModule($moduleRegistration, $cancellationPercentage, $moduleFee, "Cancelation");
        
            $registrationStatus = RegistrationStatus::find(2);

            return response()->json([
                'status' => 1,
                'moduleRegistrationId' => $request->module_registration_id,
                'registrationStatus' => $registrationStatus->status,
                'message' => 'Module successfully cancelled. Please check if correct credits have been applied.',
            ]);

        } else {
            return response()->json([
                'status' => 0,
                'message' => 'There was a problem cancelling this module, the cancellation process is closed.',
            ]);
        }
        
    }

    public function removeExemption(Request $request){
        $moduleRegistration = ModuleRegistration::with('module')->find($request->module_registration_id);

        try {
            if ($moduleRegistration->is_exempted) {
                $this->removeExemptionCharges($moduleRegistration);

                $moduleRegistration->is_exempted = 0;
                $moduleRegistration->updated_by = auth()->user()->id;
                $moduleRegistration->exemption_reason = null;
                $moduleRegistration->save();

                return response()->json([
                    'status' => 1,
                    'message' => 'Module Exemption successfully removed',
                    'exemptionStatus' => 'Exempted',
                    'moduleRegistrationId' => $moduleRegistration->id
                ]);
            }
        } catch (Exception $exception) {
            
            return response()->json([
                'status' => 0,
                'message' => 'An unexpected error occured.',
            ]);
        }
    }

    private function removeExemptionCharges($moduleRegistration){
        $studentAccount = Account::whereIn('transaction_type', ['Exemption', 'Cancellation'])
            ->where('model_id', $moduleRegistration->module->id)
            ->where('user_info_id', $moduleRegistration->user_info_id)
            ->where('model_type', 'Module')
            ->get();
        
        $exemption = $studentAccount->where('transaction_type', 'Exemption')->first();

        $cancellation = $studentAccount->where('transaction_type', 'Cancellation')->first();

        Account::create([
            'user_info_id' => $moduleRegistration->user_info_id,
            'financial_year_id' => $moduleRegistration->academic_year_id,
            'reference' => 'C/N Exemption',
            'transaction_date' => date('Y-m-d'),
            'transaction_description' => 'R/E ' . $moduleRegistration->module->module_name,
            'transaction_type' => 'RE',
            'model_type' => 'Module',
            'model_id' => $moduleRegistration->module->id,
            'debit' => 0,
            'credit' => $exemption->debit,
        ]);

        Account::create([
            'user_info_id' => $moduleRegistration->user_info_id,
            'financial_year_id' => $moduleRegistration->academic_year_id,
            'reference' => 'Register',
            'transaction_date' => date('Y-m-d'),
            'transaction_description' => $moduleRegistration->module->module_name,
            'transaction_type' => 'ModuleRegistration',
            'model_type' => 'Module',
            'model_id' => $moduleRegistration->module->id,
            'debit' => $cancellation->credit,
            'credit' => 0,
        ]);
    }

     public function reverseCancellation(Request $request){

        $moduleRegistration = ModuleRegistration::with('module')->find($request->module_registration_id);

        $qualificationRegistration = Registration::where('user_info_id', $moduleRegistration->user_info_id)
                                                ->where('academic_year_id', $moduleRegistration->academic_year_id)
                                                ->first();
        if($qualificationRegistration->is_cancelled){
            return response()->json([
                'status' => 0,
                'message' => 'The cancellation cannot be reversed because the qualification is cancelled.'
              
            ]);
        }

        try{
            if($moduleRegistration->is_cancelled){
                $this->reverseCancellationCredit($moduleRegistration);

                $moduleRegistration->is_cancelled = 0;
                $moduleRegistration->registration_status_id = 1;
                $moduleRegistration->cancel_date = null;
                $moduleRegistration->updated_by = auth()->user()->id;
                $moduleRegistration->cancel_reason = null;
                $moduleRegistration->save();

                return response()->json([
                    'status' => 1,
                    'message' => 'The cancellation for this module has been reversed.',
                    'registrationStatus' => 'Registered',
                    'moduleRegistrationId' => $moduleRegistration->id
                ]);
            }
        } catch(Exception $exception){
            
            return response()->json([
                'status' => 0,
                'message' => 'An unexpected error occured.',
            ]);
        }

       
    }

    private function reverseCancellationCredit($moduleRegistration){

        $credit = 0;

        $studentAccount = Account::where('transaction_type', 'Cancellation')
                                  ->where('user_info_id', $moduleRegistration->user_info_id)
                                  ->where('model_id', $moduleRegistration->module->id)
                                  ->where('model_type', 'Module')
                                  ->first();
        if($studentAccount){
            $credit = $studentAccount->credit;
        }

        Account::create([
            'user_info_id' => $moduleRegistration->user_info_id,
            'financial_year_id' => $moduleRegistration->academic_year_id,
            'reference' => 'Reverse Cancellation',
            'transaction_date' => date('Y-m-d'),
            'transaction_description' => 'R/C '.$moduleRegistration->module->module_name,
            'transaction_type' => 'RC',
            'model_type' => 'Module',
            'model_id' => $moduleRegistration->module->id,
            'debit' => $credit,
            'credit' => 0,
        ]);

    }

    private function getCancelationPercentage($moduleRegistration, $request)
    {
        $moduleCancellationPolicy = ModuleCancellationPolicy::where('date_from', '<=', $request->cancellation_date)
                                                            ->where('date_to', '>=', $request->cancellation_date)
                                                            ->where('academic_year_id', $moduleRegistration->academic_year_id)
                                                            ->where('academic_intake_id', $moduleRegistration->academic_intake_id)
                                                            ->where('study_period_id', $moduleRegistration->study_period_id)
                                                            ->first();
        return $moduleCancellationPolicy;
    }

    private function getExemptionFees($moduleRegistration, $studentTypeId){
        
        return OtherFee::with('feeType')
                        ->where('academic_year_id', $moduleRegistration->academic_year_id)
                        ->where('academic_process', 'Exemption')
                        ->where('student_type_id', $studentTypeId)
                        ->first();

    }

    private function getModuleFee($moduleRegistration, $helper){
        $subjectFee = SubjectFee::where('module_id', $moduleRegistration->module_id)
                                ->where('academic_year_id', $moduleRegistration->academic_year_id)
                                ->where('assessment_type_id', $moduleRegistration->assessment_type_id)
                                ->where('student_type_id', $moduleRegistration->userInfo->citizenship_status)
                                ->first();

        return $subjectFee;
    }

    private function moduleHasAssessments($moduleRegistration){

        $caMarkTypes = CaMarkTypes::where('module_id', $moduleRegistration->module_id)
                                    ->where('academic_year_id', $moduleRegistration->academic_year_id)
                                    ->where('academic_intake_id', $moduleRegistration->academic_intake_id)
                                    ->where('study_mode_id', $moduleRegistration->study_mode_id)
                                    ->where('campus_id', $moduleRegistration->campus_id)
                                    ->where('user_info_id', $moduleRegistration->user_info_id)
                                    ->get();
        
        if(count($caMarkTypes)){
            return true;
        }

        return false;
    }

    public function exemptModule(Request $request, Helper $helper, StudentAccount $studentAccount)
    {
        try {
            $moduleRegistration = ModuleRegistration::with('module')->find($request->module_registration_id);

            if ($this->moduleHasAssessments($moduleRegistration)) {

                return response()->json([
                    'status' => 0,
                    'message' => 'Error while exempting module. Assessments have already been captured.',
                ]);
            }

            if ($moduleRegistration->is_exempted == 1) {

                return response()->json([
                    'status' => 0,
                    'message' => 'Error while exempting module. This module has already been exempted.',
                ]);
            }

            if ($moduleRegistration->is_cancelled == 1) {

                return response()->json([
                    'status' => 0,
                    'message' => 'Error while exempting module. This module is cancelled.',
                ]);
            }

            if ($helper->isExemptionProcessOpen($moduleRegistration->academic_year_id, $moduleRegistration->academic_intake_id)) {

                $studentTypeId = $moduleRegistration->userInfo->citizenship_status;

                $exemptionFees = $this->getExemptionFees($moduleRegistration, $studentTypeId);
                
                if(!$exemptionFees){
                    return response()->json([
                        'status' => 0,
                        'message' => 'Error while exempting module. Exemption fees not defined.',
                    ]);
                }

                $moduleFee = $this->getModuleFee($moduleRegistration, $helper);

                if(!$moduleFee){
                    return response()->json([
                        'status' => 0,
                        'message' => 'There was a problem exempting this module, Please define the module fee for the correct assessment type.',
                    ]);
                }

                Account::create([
                    'user_info_id' => $moduleRegistration->user_info_id,
                    'financial_year_id' => $exemptionFees->academic_year_id,
                    'reference' => "Exemption",
                    'transaction_date' => date('Y-m-d'),
                    'transaction_description' => $exemptionFees->feeType->fee_type_name,
                    'transaction_type' => 'Exemption',
                    'model_type' => 'Module',
                    'model_id' => $moduleRegistration->module->id,
                    'debit' => $exemptionFees->amount,
                    'credit' => 0
                ]);


                $moduleRegistration->is_exempted = 1;
                $moduleRegistration->exemption_date = date('Y-m-d h:i:s');
                $moduleRegistration->updated_by = auth()->user()->id;
                $moduleRegistration->exemption_reason = $request->cancellation_reason;
                $moduleRegistration->save();

                $studentAccount->creditStudentCancellationModule($moduleRegistration, 100, $moduleFee, "Exemption");

                return response()->json([
                    'status' => 1,
                    'moduleRegistrationId' => $request->module_registration_id,
                    'exemptionStatus' => 'Not-Exempted',
                    'message' => 'Module successfully exempted. Please check if correct credits have been applied.',
                ]);
            } else {
                return response()->json([
                    'status' => 0,
                    'message' => 'There was a problem exempting this module, the exemption process is closed.',
                ]);
            }
        } catch (Exception $e) {
            
            return response()->json([
                'status' => 0,
                'message' => 'An unexpected error occured.',
            ]);
        }
    }

    private function CheckIfModuleFeeDefined($modules, $subjectFees){
        
        foreach($modules as $module){
            $subjectFee = $subjectFees->where('module_id', $module)->first();
            if(!$subjectFee){
                return [
                    'defined' => false,
                    'module_id' => $module
                ];
            }
        }

        return [
            'defined' => true,
            'module_id' => 0
        ];
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
            'module_id' => 'required',
            'study_mode_id' => 'required',
            'study_period_id' => 'required',
            'registration_id' => 'required',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
