<?php

namespace App\Http\Controllers;

use App\Models\AcademicIntake;
use App\Models\AcademicProcess;
use App\Models\AcademicYear;
use App\Models\AdmissionStatus;
use App\Models\Application;
use App\Models\Module;
use App\Models\ModuleRegistration;
use App\Models\Registration;
use App\Models\UserInfo;
use Illuminate\Http\Request;

class AcademicDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(){
        $academicYearId = AcademicYear::where('name', date('Y'))->first();

        $academicYearId = $academicYearId->id ?? 0;

        $academicTallies = $this->getAcademicTallies($academicYearId);

        $enrolmentCampusStatistics = $this->enrolmentCampusStatistics();

        $registrationsByQualification = $this->getRegistrationsByQualification();

        $registrationVsAdmission = $this->admissionVsRegistration($academicYearId);
        
        $applications = Application::selectRaw('count(user_info_id) as applications, DATE_FORMAT(created_at, "%M") as application_date')
                                    ->where('academic_year_id', $academicYearId)
                                    ->groupBy('application_date')
                                    ->get()
                                    ->toArray();

        $applicationsPerMonth = array();

        $applicationCategories = array();
        
        foreach($applications as $key => $value){

            array_push($applicationsPerMonth, $value['applications']);

            array_push($applicationCategories, $value['application_date']);
        }

        $subjectStatistics = $this->subjectEnrolmentStatistics($academicYearId);
        
        return view('pages.dashboards.academic', compact('applicationsPerMonth', 'applicationCategories', 'academicTallies', 'subjectStatistics', 'enrolmentCampusStatistics', 'registrationsByQualification', 'registrationVsAdmission'));
    }

    private function getAcademicTallies($academicYearId){
        $applications = Application::select('user_info_id')
                                    ->where('academic_year_id', $academicYearId)
                                    ->get();
    

        $applicants = $applications->unique('user_info_id')->count();

        $applications = $applications->count();

        $registrations = Registration::select('user_info_id', 'promotion_status')
                                        ->where('registration_status_id', 1)
                                        ->get();

        $students = $registrations->unique('user_info_id')->count();

        $enrolments = $registrations->where('promotion_status', 0)->count();

        return [
            'applicants' => $applicants,
            'applications' => $applications,
            'enrolments' => $enrolments,
            'students' => $students,
        ];
    }

    private function subjectEnrolmentStatistics($academicYearId){

        $modules = Module::where('active', 1)->count();

        $enrolmentPerSubject = ModuleRegistration::selectRaw('modules.module_name, modules.module_code, count(user_info_id) as count')
                                                ->join('modules','modules.id', '=', 'module_registrations.module_id')
                                                ->where('academic_year_id', $academicYearId)
                                                ->where('is_cancelled', 0)
                                                ->groupBy('module_name', 'module_code')
                                                ->orderBy('count', 'desc')
                                                ->get();
        
        return [
            'totalModules' => $modules,
            'enrolmentPerSubject' => $enrolmentPerSubject
        ];
    }

    private function enrolmentCampusStatistics(){

        $campusRegistrations = Registration::selectRaw('campuses.name as campus_name, gender_types.gender_type, count(user_info_id) as count')
                                                ->join('campuses', 'campuses.id', '=', 'registrations.campus_id')
                                                ->join('user_infos', 'user_infos.id', '=', 'registrations.user_info_id')
                                                ->join('gender_types', 'gender_types.id', '=', 'user_infos.gender_id')
                                                ->where('promotion_status', 0)
                                                ->where('registration_status_id', 1)
                                                ->groupBy('campus_name', 'gender_type')
                                                ->orderBy('count', 'desc')
                                                ->get();
        
        $campusGenderTypes = array();

        foreach($campusRegistrations as $campusRegistration){
            $campusGenderTypes[$campusRegistration->campus_name][$campusRegistration->gender_type] =  $campusRegistration->count;
        }
        
        
        return $campusGenderTypes;
       
    }

    private function getRegistrationsByQualification(){
        $registrations = Registration::selectRaw('count(user_info_id) as count, qualifications.qualification_name, qualifications.qualification_code')
                                    ->join('qualifications', 'qualifications.id', '=', 'registrations.qualification_id')
                                    ->join('campuses', 'campuses.id', '=', 'registrations.campus_id')
                                    ->where('promotion_status', 0)
                                    ->groupBy('qualifications.qualification_code', 'qualification_name')
                                    ->orderBy('count', 'desc')
                                    ->get();

        $categories = array();
        $campuses = array();
        $qualificationCampuses = array();
        $values = array();

        foreach ($registrations as $application){
            array_push($categories, $application->qualification_name." (". $application->qualification_code.")");
            array_push($campuses, $application->campus_name);
            array_push($values, $application->count);
        }

        //dd($qualificationCampuses);

        $registrationsPerCampus = Registration::selectRaw('count(user_info_id) as count, campuses.name as campus_name, qualifications.qualification_name, qualifications.qualification_code')
                                    ->join('qualifications', 'qualifications.id', '=', 'registrations.qualification_id')
                                    ->join('campuses', 'campuses.id', '=', 'registrations.campus_id')
                                    ->where('promotion_status', 0)
                                    ->groupBy('qualifications.qualification_code', 'qualification_name', 'campus_name')
                                    ->orderBy('count', 'desc')
                                    ->get();

        return [
            'categories' => $categories,
            'campuses' => array_unique($campuses),
            'qualificationCampuses' => $qualificationCampuses,
            'registrationsPerCampus' => $registrationsPerCampus,
            'values' => $values,
        ];
    }

    private function admissionVsRegistration($academicYearId){
        $fullAdmissionId = AdmissionStatus::where('full_admission', 1)->pluck('id', 'id');

        $applications = Application::selectRaw('application_status_id, campuses.name as campus_name, count(user_info_id) as count')
                                ->join('campuses', 'campuses.id', '=', 'applications.campus_id')
                                ->whereIn('academic_year_id', [$academicYearId, $academicYearId - 1])
                                ->groupBy('campuses.name', 'application_status_id')
                                ->get();

        $applicationsByCampus = array();

        foreach ($applications as $key => $value){
            
            $applicationsByCampus[$value->campus_name] = $applications->where('campus_name', $value->campus_name)->sum('count');
        }
        
        $admissions = $applications->whereIn('application_status_id', $fullAdmissionId)
                                    ->sum('count');

        $registration = Registration::select('user_info_id')
                                ->where('promotion_status', 0)
                                ->where('registration_status_id', 1)
                                ->count();
        
        return [
            'admissionsCount' => $admissions,
            'registrationCount' => $registration,
            'applicationsCount' => $applications->sum('count'),
            'applicationsByCampus' => $applicationsByCampus
        ];
    }
}
