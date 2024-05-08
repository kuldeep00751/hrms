<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Application;
use App\Models\Lov;
use App\Models\ModuleRegistration;
use App\Models\Registration;
use App\Models\StudentLetter;
use App\Models\StudentSubjectDetail;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentDocsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function proofOfRegistration(){
        $studentRegistration = array();

        return view('pages.student_docs.proof_of_registration.index', compact('studentRegistration'));
    }

    public function showProofOfRegistration(Request $request){

        $userInfo = null;

        if(isset($request->student_number)){
            $userInfo = UserInfo::where('student_number', $request->student_number)->first();
        }

        if (isset($request->id_number)) {
            $userInfo = UserInfo::where('id_number', $request->id_number)->first();
        }

        if(!$userInfo){
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Student not found, please make sure the student number or ID number is correct.']);
        }

        $studentRegistration = Registration::with('userInfo', 'academicYear', 'academicIntake', 'campus', 'qualification', 'yearLevel', 'studyMode', 'registrationStatus')
                                    ->where('user_info_id', $userInfo->id)
                                    ->get();


        if(!count($studentRegistration)){
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Student not registered.']);
        }

        return view('pages.student_docs.proof_of_registration.index', compact('studentRegistration', 'userInfo'));

    }

    public function showRegistrationModules($registrationId){

        $studentRegistration = Registration::with('userInfo', 'academicYear', 'academicIntake', 'campus', 'qualification', 'yearLevel', 'studyMode')
                            ->find($registrationId);

        $moduleRegistration = ModuleRegistration::where('academic_year_id', $studentRegistration->academic_year_id)
                                                ->where('user_info_id', $studentRegistration->user_info_id)
                                                ->where('qualification_id', $studentRegistration->qualification_id)
                                                ->where('is_cancelled', 0)
                                                ->get();

        return view('pages.student_docs.proof_of_registration.show', compact('studentRegistration', 'moduleRegistration'));
    }

    public function printProofOfRegistration($id)
    {
        $lov = Lov::all();

        $studentRegistration = Registration::with('userInfo', 'qualification', 'studyMode', 'yearLevel', 'campus', 'academicYear', 'academicIntake')->find($id);

        $moduleRegistration = ModuleRegistration::with('studyMode', 'module', 'studyPeriod', 'academicIntake')
            ->where('user_info_id', $studentRegistration->user_info_id)
            ->where('academic_year_id', $studentRegistration->academic_year_id)
            ->where('qualification_id', $studentRegistration->qualification_id)
            ->where('campus_id', $studentRegistration->campus_id)
            ->where('is_cancelled', 0)
            ->get();


        return view('pages.student_docs.proof_of_registration.print', compact('studentRegistration', 'moduleRegistration', 'lov'));
    }

    public function academicRecord()
    {
        return view('pages.student_docs.academic_record.index');
    }

    public function academicRecordQualifications(Request $request)
    {
        $userInfo = null;

        if (isset($request->student_number)) {
            $userInfo = UserInfo::where('student_number', $request->student_number)->first();
        }

        if (isset($request->id_number)) {
            $userInfo = UserInfo::where('id_number', $request->id_number)->first();
        }

        if (!$userInfo) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Student not found, please make sure the student number or ID number is correct.']);
        }

        $studentRegistration = Registration::with('qualification')
                                            ->select('qualification_id')
                                            ->where('user_info_id', $userInfo->id)
                                            ->where('registration_status_id', 1)
                                            ->groupBy('qualification_id')
                                            ->get();

        return view('pages.student_docs.academic_record.qualifications', compact('studentRegistration', 'userInfo'));
    }

    public function academicRecordStudentQualifications($id)
    {

        $userInfo = UserInfo::find($id);

        $studentRegistration = Registration::where('user_info_id', $userInfo->id)
                                            ->where('registration_status_id', 1)
                                            ->get();

        return view('pages.student_docs.academic_record.qualifications', compact('studentRegistration'));
    }


    public function viewAcademicAcademicRecord($qualification_id, $userInfoId)
    {

        $registrations = Registration::where('qualification_id', $qualification_id)
                                    ->where('user_info_id', $userInfoId)
                                    ->get();

        $subjectDetails = StudentSubjectDetail::select('first_names', 'title', 'surname','student_number', 'id_number', 'qualification_name', 'qualification_code','academic_intake', 'study_mode', 'campus_name', 'academic_year', 'module_name','module_code', 'study_period', 'assessment_type', 'final_mark', 'result_code', 'result_code_description', 'promotion_result')
            ->where('qualification_id', $qualification_id)
            ->where('is_cancelled', 0)
            ->where('user_info_id', $userInfoId)
            ->orderBy('academic_year_id')
            ->orderBy('registration_id')
            ->orderBy('module_name')
            ->get();

        return view('pages.student_docs.academic_record.show', compact('subjectDetails', 'registrations'));
    }

    public function printAcademicRecord($qualification_id, $userInfoId)
    {
        $lov = Lov::all();

        $registrations = Registration::where('qualification_id', $qualification_id)
            ->where('user_info_id', $userInfoId)
            ->get();

        $subjectDetails = StudentSubjectDetail::select('user_info_id', 'title', 'first_names', 'surname', 'student_number', 'id_number', 'qualification_name', 'qualification_code','academic_intake', 'study_mode', 'campus_name', 'academic_year', 'module_name', 'module_code', 'study_period', 'assessment_type', 'final_mark', 'result_code', 'result_code_description', 'promotion_result')
        ->where('qualification_id', $qualification_id)
            ->where('is_cancelled', 0)
            ->where('user_info_id', $userInfoId)
            ->orderBy('academic_year_id')
            ->orderBy('registration_id')
            ->orderBy('module_name')
            ->get();

        return view('pages.student_docs.academic_record.print', compact('subjectDetails', 'registrations', 'lov'));
    }

    public function studentLetterIndex(){

        $studentLetters = StudentLetter::pluck('letter_name', 'id')->all();

        return view('pages.student_docs.student_letter.index', compact('studentLetters'));
    }

    public function downloadStudentLetter(Request $request){

        $userInfo = UserInfo::select('id')
                            ->where('student_number', $request->student_number)
                            ->first();

        if(!$userInfo){
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Invalid student number entered.']);
        }

        $studentLetter = StudentLetter::find($request->student_letter_id);

        $studentApplication = Application::where('user_info_id', $userInfo->id)
                                        ->where('academic_year_id', $studentLetter->academic_year_id)
                                        ->whereIn('application_status', $studentLetter->admission_status_id)
                                        ->whereIn('academic_intake_id', $studentLetter->academic_intake_id)
                                        ->whereIn('campus_id', $studentLetter->campus_id)
                                        ->whereIn('qualification_id', $studentLetter->qualification_id)
                                        ->first();

        if(!$studentApplication){
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Student letter not found, does not meet set criteria.']);
        }

        $letterParameters = $this->getLetterParameters($studentApplication);

        $pdf = Pdf::loadView('pages.applications.user_info.letter', compact('studentLetter', 'letterParameters'))->setPaper('a4', 'portrait');

        return $pdf->download($studentApplication->userInfo->student_number . "_" . $studentLetter->letter_name . ".pdf");
    }

    protected function getLetterParameters($data)
    {

        return [
            'StudentNumber' => $data->userInfo->student_number,
            'IDNumber' => $data->userInfo->id_number,
            'Title' => $data->userInfo->title->title,
            'StudentFirstName' => $data->userInfo->first_names,
            'StudentSurname' => $data->userInfo->surname,
            'StudentAddressLine1' => $data->userInfo->residential_address_line_1,
            'StudentAddressLine2' => $data->userInfo->residential_address_line_2,
            'StudentAddressLine3' => $data->userInfo->residential_address_line_3,
            'StudentEmail' => $data->userInfo->email_address,
            'Date' => date('d M Y'),
            'StudentPostalAddress1' => $data->userInfo->postal_address_line_1,
            'StudentPostalAddress2' => $data->userInfo->postal_address_line_2,
            'StudentPostalAddress3' => $data->userInfo->postal_address_line_3,
            'QualificationName' => $data->qualification->qualification_name,
            'QualificationCode' => $data->qualification->qualification_code,
            'CampusName' => $data->campus->name,
            'AcademicIntake' => $data->academicIntake->name,
            'AcademicYear' => $data->academicYear->name,
            'AdmissionStatus' => $data->admission_status
        ];
    }
}
