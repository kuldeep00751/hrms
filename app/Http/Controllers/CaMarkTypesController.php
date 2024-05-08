<?php

namespace App\Http\Controllers;

use App\Actions\ProcessCaMarks;
use App\Exports\CaReport;
use App\Models\AcademicIntake;
use App\Models\AcademicYear;
use App\Models\AssessmentType;
use App\Models\AttendanceRegister;
use App\Models\CaMarkTypes;
use App\Models\Campus;
use App\Models\ContinuousAssessmentWeight;
use App\Models\ExamAdmissionCriteria;
use App\Models\Module;
use App\Models\ModuleAllocation;
use App\Models\ModuleRegistration;
use App\Models\StudentCa;
use App\Models\StudyMode;
use Excel;
use Illuminate\Http\Request;

class CaMarkTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $user = auth()->user();
        
        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $filterData = $this->filterData($request);

        $lecturerModules = ModuleAllocation::with('module')->where('user_id', $user->id)->get();

        $continuousAssessmentTypes = ContinuousAssessmentWeight::whereIn('module_id', $lecturerModules->pluck('module_id'))
                                                                ->whereIn('academic_year_id', $lecturerModules->pluck('academic_year_id'))
                                                                ->get();

        return view('pages.assessments.continuous_assessments.index', compact('academicYears', 'academicIntakes', 'studyModes', 'modules', 'campuses', 'filterData', 'lecturerModules', 'continuousAssessmentTypes'));
    }

    private function filterData($request)
    {
        if (count($request->all())) {
            return $request->all();
        } else {
            return [
                'academic_year_id' => 0,
                'academic_intake_id' => 0,
                'module_id' => 0,
                'campus_id' => 0,
                'study_mode_id' => 0
            ];
        }
    }

    public function filter(Request $request){
        
        $data = $this->getData($request);
        
        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $filterData = $this->filterData($request);

        session()->put($filterData);

        $moduleRegistration = ModuleRegistration::with('academicYear', 'academicIntake', 'studyMode', 'module', 'campus')
                                                ->where('is_exempted', 0)
                                                ->where('is_cancelled', 0)
                                                ->where('academic_year_id', $data['academic_year_id'])
                                                ->where('academic_intake_id', $data['academic_intake_id'])
                                                ->where('study_mode_id', $data['study_mode_id'])
                                                ->where('module_id', $data['module_id'])
                                                ->where('campus_id', $data['campus_id'])
                                                ->first();
        
        if(!$moduleRegistration){
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'There are no students enrolled for this module.']);
        }

        $continuousAssessmentTypes = ContinuousAssessmentWeight::where('module_id', $moduleRegistration->module_id)
                                                            ->where('academic_year_id', $moduleRegistration->academic_year_id)
                                                            ->get();

        if(!count($continuousAssessmentTypes)){
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'There are no assessments defined for this module.']);
        }

        return view('pages.assessments.continuous_assessments.index', compact('academicYears', 'academicIntakes', 'studyModes', 'modules', 'campuses', 'filterData', 'moduleRegistration', 'continuousAssessmentTypes'));
    }

    public function showAssessment($moduleAllocationId, $continuousAssessmentTypeId)
    {
        $moduleAllocation = ModuleAllocation::find($moduleAllocationId);

        $moduleRegistrations = ModuleRegistration::with('academicYear', 'academicIntake', 'studyMode', 'module', 'campus')
                                                ->where('academic_year_id', $moduleAllocation->academic_year_id)
                                                ->where('is_exempted', 0)
                                                ->where('is_cancelled', 0)
                                                ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
                                                ->where('study_mode_id', $moduleAllocation->study_mode_id)
                                                ->where('module_id', $moduleAllocation->module_id)
                                                ->where('campus_id', $moduleAllocation->campus_id)
                                                ->join('user_infos', 'user_infos.id', '=', 'module_registrations.user_info_id')
                                                ->orderBy('user_infos.surname')
                                                ->get();
        
        if(!count($moduleRegistrations)){
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'There are no students enrolled for this module.']);
        }

        $continuousAssessmentType = ContinuousAssessmentWeight::find($continuousAssessmentTypeId);

        $caMarkTypes = CaMarkTypes::where('module_id', $moduleAllocation->module_id)
                                    ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
                                    ->where('study_mode_id', $moduleAllocation->study_mode_id)
                                    ->where('module_id', $moduleAllocation->module_id)
                                    ->where('campus_id', $moduleAllocation->campus_id)
                                    ->where('mark_type_id', $continuousAssessmentType->id)
                                    ->get();

        return view('pages.assessments.continuous_assessments.assessments', compact('moduleRegistrations', 'continuousAssessmentType', 'caMarkTypes'));
    }

    public function viewAll($moduleAllocationId){

        $moduleAllocation = ModuleAllocation::find($moduleAllocationId);
        
        $moduleRegistrations = ModuleRegistration::with('academicYear', 'academicIntake', 'studyMode', 'module', 'campus')
            ->where('academic_year_id', $moduleAllocation->academic_year_id)
            ->where('is_exempted', 0)
            ->where('is_cancelled', 0)
            ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
            ->where('study_mode_id', $moduleAllocation->study_mode_id)
            ->where('module_id', $moduleAllocation->module_id)
            ->where('campus_id', $moduleAllocation->campus_id)
            ->join('user_infos', 'user_infos.id', '=', 'module_registrations.user_info_id')
            ->orderBy('user_infos.surname')
            ->get();

        if (!count($moduleRegistrations)) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'There are no students enrolled for this module.']);
        }
        
        $caMarkTypes = CaMarkTypes::with('userInfo')->where('module_id', $moduleAllocation->module_id)
                                ->where('academic_year_id', $moduleAllocation->academic_year_id)
                                ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
                                ->where('study_mode_id', $moduleAllocation->study_mode_id)
                                ->where('campus_id', $moduleAllocation->campus_id)
                                ->get();

        $studentCas = StudentCa::where('module_id', $moduleAllocation->module_id)
                                ->where('academic_year_id', $moduleAllocation->academic_year_id)
                                ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
                                ->where('study_mode_id', $moduleAllocation->study_mode_id)
                                ->where('campus_id', $moduleAllocation->campus_id)
                                ->get();

        $defaultAssessment = $this->getDefaultAssessment();

        $criteria  = $this->getExamAdmissionCriteria($moduleAllocation->module_id, $moduleAllocation->academic_year_id, $defaultAssessment->id);

        $attendanceRegister = AttendanceRegister::select('user_info_id', 'attendance_duration')
                                                ->where('module_id', $moduleAllocation->module_id)
                                                ->where('academic_year_id', $moduleAllocation->academic_year_id)
                                                ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
                                                ->where('study_mode_id', $moduleAllocation->study_mode_id)
                                                ->where('campus_id', $moduleAllocation->campus_id)
                                                ->join('attendance_register_students', 'attendance_register_students.attendance_register_id', '=', 'attendance_registers.id')
                                                ->get();

        foreach ($studentCas as $key => $studentCa) {
            $studentCa['qualified'] = $this->getQualified($criteria, $studentCa->ca_mark);
            
            $totalAttendedHours = $attendanceRegister->where('user_info_id', $studentCa->user_info_id)->sum('attendance_duration');
            $studentCa['attendancePercentage'] = $this->getAttendancePercentage($criteria, $totalAttendedHours);
        }

        
        $continuousAssessmentWeights = ContinuousAssessmentWeight::select('assessment_description', 'id')
                                                                    ->where('module_id', $moduleAllocation->module_id)
                                                                    ->where('academic_year_id', $moduleAllocation->academic_year_id)
                                                                    ->get();
        
        return view('pages.assessments.continuous_assessments.report', compact('caMarkTypes', 'continuousAssessmentWeights', 'studentCas', 'moduleRegistrations', 'moduleAllocation'));
    }

    /**
     * Manually retrieve the ExamAdmissionCriteria for the StudentCas based on
     * module_id, academic_year_id, and assessment_type_id.
     *
     * @return ExamAdmissionCriteria|null
     */
    public function getExamAdmissionCriteria($moduleId, $academicYearId, $assessmentId)
    {
        return ExamAdmissionCriteria::where('module_id', $moduleId)
            ->where('academic_year_id', $academicYearId)
            ->where('assessment_type_id', $assessmentId)
            ->first();
    }

    public function getQualified($criteria, $caMark)
    {
        if ($criteria && isset($caMark)) {
            $minimumCaMark = $criteria->minimum_ca_mark;
            $marks = $caMark;

            return $marks >= $minimumCaMark ? 'Qualified' : 'Not Qualified';
        }

        return 'Not Qualified';
    }

    public function getAttendancePercentage($criteria, $attendance){

        if ($criteria && isset($attendance)) {
            $minimumAttendance = $criteria->minimum_attendance;
            $attendance = $attendance;

            return intval(($attendance / $minimumAttendance) * 100);
        }

        return 0;
    }

    private function getDefaultAssessment(){
        return AssessmentType::where('default', 1)->first();
    }

    public function downloadCaReport($moduleAllocationId)
    {

        $moduleAllocation = ModuleAllocation::find($moduleAllocationId);

        $moduleRegistrations = ModuleRegistration::with('academicYear', 'academicIntake', 'studyMode', 'module', 'campus')
                                            ->where('academic_year_id', $moduleAllocation->academic_year_id)
                                                ->where('is_exempted', 0)
                                                ->where('is_cancelled', 0)
                                                ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
                                                ->where('study_mode_id', $moduleAllocation->study_mode_id)
                                                ->where('module_id', $moduleAllocation->module_id)
                                                ->where('campus_id', $moduleAllocation->campus_id)
                                                ->join('user_infos', 'user_infos.id', '=', 'module_registrations.user_info_id')
                                                ->orderBy('user_infos.surname')
                                                ->get();
        session()->put('moduleRegistrations', $moduleRegistrations);

        $caMarkTypes = CaMarkTypes::with('userInfo')->where('module_id', $moduleAllocation->module_id)
            ->where('academic_year_id', $moduleAllocation->academic_year_id)
            ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
            ->where('study_mode_id', $moduleAllocation->study_mode_id)
            ->where('campus_id', $moduleAllocation->campus_id)
            ->get();

        session()->put('caMarkTypes', $caMarkTypes);

        $studentCas = StudentCa::where('module_id', $moduleAllocation->module_id)
            ->where('academic_year_id', $moduleAllocation->academic_year_id)
            ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
            ->where('study_mode_id', $moduleAllocation->study_mode_id)
            ->where('campus_id', $moduleAllocation->campus_id)
            ->get();
        
        $defaultAssessment = $this->getDefaultAssessment();
        
        $criteria  = $this->getExamAdmissionCriteria($moduleAllocation->module_id, $moduleAllocation->academic_year_id, $defaultAssessment->id);

        $attendanceRegister = AttendanceRegister::select('user_info_id', 'attendance_duration')
        ->where('module_id', $moduleAllocation->module_id)
            ->where('academic_year_id', $moduleAllocation->academic_year_id)
            ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
            ->where('study_mode_id', $moduleAllocation->study_mode_id)
            ->where('campus_id', $moduleAllocation->campus_id)
            ->join('attendance_register_students', 'attendance_register_students.attendance_register_id', '=', 'attendance_registers.id')
            ->get();

        foreach ($studentCas as $key => $studentCa) {
            $studentCa['qualified'] = $this->getQualified($criteria, $studentCa->ca_mark);

            $totalAttendedHours = $attendanceRegister->where('user_info_id', $studentCa->user_info_id)->sum('attendance_duration');
            $studentCa['attendancePercentage'] = $this->getAttendancePercentage($criteria, $totalAttendedHours);
        }

        session()->put('studentCas', $studentCas);

        $continuousAssessmentWeights = ContinuousAssessmentWeight::select('assessment_description', 'id')
                                                                ->where('module_id', $moduleAllocation->module_id)
                                                                ->where('academic_year_id', $moduleAllocation->academic_year_id)
                                                                ->get();

        session()->put('continuousAssessmentWeights', $continuousAssessmentWeights);

        $filename = $moduleAllocation->module->module_name . "ca_report";

        return Excel::download(new CaReport, $filename . '' . '.xlsx');

    }

    public function store(Request $request, ProcessCaMarks $ca)
    {
        
        $caMarkTypes = CaMarkTypes::where('module_id', $request->module_id)
                                    ->where('academic_year_id', $request->academic_year_id)
                                    ->where('academic_intake_id', $request->academic_intake_id)
                                    ->where('study_mode_id', $request->study_mode_id)
                                    ->where('campus_id', $request->campus_id)
                                    ->where('mark_type_id', $request->mark_type_id)
                                    ->get();
        
        foreach($request->user_info_id as $key=>$userInfoId){
            $studentMark = $caMarkTypes->where('user_info_id', $userInfoId)->first();

            if($studentMark){
                $studentMark->mark = floatval($request->mark[$userInfoId]);
                $studentMark->updated_by = auth()->user()->id;
                $studentMark->save();
            } else {
                CaMarkTypes::create([
                    'user_info_id' => $userInfoId,
                    'module_id' => $request->module_id,
                    'academic_year_id' => $request->academic_year_id,
                    'academic_intake_id' => $request->academic_intake_id,
                    'study_mode_id' => $request->study_mode_id,
                    'campus_id' => $request->campus_id,
                    'mark_type_id' => $request->mark_type_id,
                    'mark' => floatval($request->mark[$userInfoId]),
                    'created_by' => auth()->user()->id
                ]);
            }
        }

        $ca->process($request);

        $moduleAllocation = ModuleAllocation::where('module_id', $request->module_id)
                                        ->where('academic_year_id', $request->academic_year_id)
                                        ->where('academic_intake_id', $request->academic_intake_id)
                                        ->where('study_mode_id', $request->study_mode_id)
                                        ->where('campus_id', $request->campus_id)
                                        ->where('user_id', auth()->user()->id)
                                        ->first();
        
        return redirect()->route('assessments.ca.show', [$moduleAllocation->id, $request->mark_type_id])
                        ->with('success_message', 'Students marks successfully saved');
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
            'academic_year_id' => 'required',
            'study_mode_id' => 'required',
            'academic_intake_id' => 'required',
            'campus_id' => 'required',
            'module_id' => 'required',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
