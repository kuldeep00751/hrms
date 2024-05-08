<?php

namespace App\Http\Controllers;

use App\Actions\Helper;
use App\Actions\SendStudentEmail;
use App\Models\AcademicIntake;
use App\Models\AcademicYear;
use App\Models\AdmissionStatus;
use App\Models\Application;
use App\Models\ApplicationType;
use App\Models\Campus;
use App\Models\Lov;
use App\Models\PdfTemplate;
use App\Models\Qualification;
use App\Models\StudentLetter;
use App\Models\StudyMode;
use App\Models\UserInfo;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class StudentLetterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $studentLetters = StudentLetter::all();

        return view('pages.communication.letters.index', compact('studentLetters'));
    }

    /**
     * Show the form for creating a new qualification.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $templates = PdfTemplate::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $applicationTypes = ApplicationType::where('active', 1)->pluck('application_type', 'id')->all();

        $qualifications = Qualification::where('active', 1)->pluck('qualification_name', 'id')->all();

        $studyModes = StudyMode::where('active', 1)->pluck('study_mode', 'id')->all();

        $campuses = Campus::where('active', 1)->pluck('name', 'id')->all();

        $admissionStatuses = AdmissionStatus::where('active', 1)->pluck('status', 'id')->all();

        return view('pages.communication.letters.create', compact('academicYears', 'academicIntakes', 'applicationTypes', 'qualifications', 'studyModes', 'campuses', 'admissionStatuses', 'templates'));
    }

    /**
     * Store a new qualification in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            $data['qualification_id'] = $this->convertToIntegers($data['qualification_id']);

            $data['campus_id'] = $this->convertToIntegers($data['campus_id']);

            $data['academic_intake_id'] = $this->convertToIntegers($data['academic_intake_id']);
            
            $studentLetter = StudentLetter::create($data);
            
            return redirect()->route('communication.letter.index')
            ->with('success_message', 'Letter was successfully added.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    /**
     * Show the form for creating a new qualification.
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $studentLetter = StudentLetter::findOrFail($id);

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $templates = PdfTemplate::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $applicationTypes = ApplicationType::where('active', 1)->pluck('application_type', 'id')->all();

        $qualifications = Qualification::where('active', 1)->pluck('qualification_name', 'id')->all();

        $studyModes = StudyMode::where('active', 1)->pluck('study_mode', 'id')->all();

        $campuses = Campus::where('active', 1)->pluck('name', 'id')->all();

        $admissionStatuses = AdmissionStatus::where('active', 1)->pluck('status', 'id')->all();

        return view('pages.communication.letters.edit', compact('academicYears', 'academicIntakes', 'applicationTypes', 'qualifications', 'studyModes', 'campuses', 'admissionStatuses', 'templates', 'studentLetter'));
    }

    public function update(Request $request, $id)
    {
        try {

            $data = $this->getData($request);

            $data['qualification_id'] = $this->convertToIntegers($data['qualification_id']);

            $data['campus_id'] = $this->convertToIntegers($data['campus_id']);

            $data['academic_intake_id'] = $this->convertToIntegers($data['academic_intake_id']);

            $studentLetter = StudentLetter::findOrFail($id);

            $studentLetter->update($data);

            return redirect()->route('communication.letter.index')
            ->with('success_message', 'Letter was successfully updated.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    private function convertToIntegers($data)
    {
        $integers = [];

        foreach ($data as $value) {
            $integers[] = (int)$value;
        }

        return $integers;
    }

    /**
     * Remove the specified qualification from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $studentLetter = StudentLetter::findOrFail($id);

            $studentLetter->delete();

            return redirect()->route('communication.letters.index')
            ->with('success_message', 'Letter was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified qualification.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        
        $studentLetter = StudentLetter::with('academicYear')->findOrFail($id);

        $applications = Application::with('userInfo', 'qualification', 'campus', 'academicIntake', 'academicIntake')
                                    ->where('application_status', $studentLetter->admission_status_id)
                                    ->where('academic_year_id', $studentLetter->academic_year_id)
                                    ->whereIn('academic_intake_id', $studentLetter->academic_intake_id)
                                    ->whereIn('campus_id', $studentLetter->campus_id)
                                    ->whereIn('qualification_id', $studentLetter->qualification_id)
                                    ->get();

        $applicationCount = $applications->count();
        
        $student = collect();
        
        $letterParameters = array();

        if($applicationCount){
            $student = $applications->first();

            $letterParameters = $this->getLetterParameters($student);
        }
        
        
        return view('pages.communication.letters.show', compact('studentLetter', 'applicationCount', 'student', 'letterParameters'));
    }

    public function downloadFromApplication($id){

        $lov = Lov::where('label', 'ACKNOWLEDGEMENT_LETTER_ID')->first();

        if (!$lov) {
            abort(404, 'Acknowledgement letter not found');
        }

        $letterId = $lov->value;

        $studentLetter = StudentLetter::find($letterId);

        if (!$studentLetter) {
            abort(404, 'Acknowledgement letter not found');
        }
        
        $studentApplication = Application::with('userInfo')
                                        ->where('user_info_id', $id)
                                        ->where('academic_year_id', $studentLetter->academic_year_id)
                                        ->whereIn('academic_intake_id', $studentLetter->academic_intake_id)
                                        ->whereIn('campus_id', $studentLetter->campus_id)
                                        ->whereIn('qualification_id', $studentLetter->qualification_id)
                                        ->first();
        
        if(!$studentApplication){
            abort(404, 'Acknowledgement letter not found');
        }
        
        $letter = $this->getLetter($studentLetter, $studentApplication);
        
        if(!$letter){
            abort(404, 'Acknowledgement letter not found');
        }

        $letterParameters = $this->getLetterParameters($studentApplication);

        $pdf = Pdf::loadView('pages.applications.user_info.letter', compact('studentLetter', 'letterParameters'))->setPaper('a4', 'portrait');
        
        return $pdf->download($studentApplication->userInfo->student_number."_" . $studentLetter->letter_name . ".pdf");
    }

    public function downloadFromEmail($letter_id, $application_id){

        $studentLetter = StudentLetter::find($letter_id);

        $userInfo = auth()->user()->info;
        
        if(!$studentLetter){
            abort(404, 'This letter is no longer available');
        }
        

        $studentApplication = Application::with('userInfo')
                                        ->where('user_info_id', $userInfo->id)
                                        ->where('id', $application_id)
                                        ->first();

        
        if(!$studentApplication){
            abort(404, 'Acknowledgement letter not found');
        }

        $letterParameters = $this->getLetterParameters($studentApplication);

        $pdf = Pdf::loadView('pages.applications.user_info.letter', compact('studentLetter', 'letterParameters'))->setPaper('a4', 'portrait');

        return $pdf->download($userInfo->student_number."_" . $studentLetter->letter_name . ".pdf");
    }

    public function sendEmail($id, SendStudentEmail $studentEmail){
        try {
            $studentLetter = StudentLetter::find($id);
            
            $applications = Application::where('academic_year_id', $studentLetter->academic_year_id)
                                        ->whereIn('academic_intake_id', $studentLetter->academic_intake_id)
                                        ->whereIn('application_status', $studentLetter->admission_status_id)
                                        ->whereIn('campus_id', $studentLetter->campus_id)
                                        ->whereIn('qualification_id', $studentLetter->qualification_id)
                                        ->get();
            
            $studentEmail->sendEmail($applications, $studentLetter);

          return redirect()->route('communication.letters.index')
            ->with('success_message', 'An email has been scheduled to all students who meet the criteria.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    private function getLetter($studentLetter, $studentApplication){

        
        $qualifications = array_values(array_unique($studentApplication->pluck('qualification_id')->toArray()));
        
        $campuses =  array_values(array_unique($studentApplication->pluck('campus_id', 'campus_id')->toArray()));

        $academicIntakes =  array_values(array_unique($studentApplication->pluck('academic_intake_id', 'academic_intake_id')->toArray()));

        $academicYearId =  array_values(array_unique($studentApplication->pluck('academic_year_id', 'academic_year_id')->toArray()));

        $admissionStatus =  array_values(array_unique($studentApplication->pluck('application_status')->toArray()));

        $letterQuery = $studentLetter->whereJsonContains('qualification_id', $qualifications)
                                    ->whereJsonContains('campus_id', $campuses)
                                    ->whereIn('academic_year_id', $academicYearId)
                                    ->whereJsonContains('academic_intake_id', $academicIntakes);

        // Add the first condition outside the loop to ensure correct logic grouping
        if (!empty($admissionStatus)) {
            $firstStatus = array_shift($admissionStatus); // Remove and return the first status
            $letterQuery->whereJsonContains('admission_status_id', $firstStatus);
        }

        // Now loop through any remaining statuses and add them with OR conditions
        foreach ($admissionStatus as $status) {
            $letterQuery->orWhereJsonContains('admission_status_id', $status);
        }

        // Retrieve the first matching record
        $letter = $letterQuery->first();
        
        return $letter;
    }

    public function previewPdf($id){
        $studentLetter = StudentLetter::with('academicYear')->findOrFail($id);

        $applications = Application::with('userInfo', 'qualification', 'campus', 'academicIntake', 'academicIntake')
            ->where('application_status', $studentLetter->admission_status_id)
            ->where('academic_year_id', $studentLetter->academic_year_id)
            ->whereIn('academic_intake_id', $studentLetter->academic_intake_id)
            ->whereIn('campus_id', $studentLetter->campus_id)
            ->whereIn('qualification_id', $studentLetter->qualification_id)
            ->get();

        $applicationCount = $applications->count();

        $student = collect();

        if ($applicationCount) {
            $student = $applications->first();
        }

        $letterParameters = $this->getLetterParameters($student);

        $pdf = Pdf::loadView('pages.communication.letters.print', compact('studentLetter', 'applicationCount', 'student', 'letterParameters'))->setPaper('a4', 'portrait');

        return $pdf->stream("Sample ".$studentLetter->letter_name . ".pdf");
    }

    protected function getLetterParameters($data){
        
        
        return [
            'StudentNumber' => $data->userInfo->student_number,
            'Title' => $data->userInfo->title->title,
            'StudentFirstName' => $data->userInfo->first_names,
            'IDNumber' => $data->userInfo->id_number,
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

    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        
        $rules = [
            'letter_name' => 'required',
            'academic_year_id' => 'required',
            'academic_intake_id' => 'required',
            'qualification_id' => 'required|array',
            'campus_id' => 'required',
            'admission_status_id' => 'required',
            'content' => 'required',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
