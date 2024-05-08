<?php

namespace App\Http\Controllers;

use App\Models\AcademicIntake;
use App\Models\AcademicYear;
use App\Models\Campus;
use App\Models\Module;
use App\Models\ModuleAllocation;
use App\Models\StudyMode;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class ModuleAllocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the qualifications.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {

        session()->forget('academic_year');
        session()->forget('academic_intake');
        session()->forget('module');
        session()->forget('user');
        session()->forget('study_mode');
        session()->forget('campus');

        $filterData = [];

        $moduleAllocations = ModuleAllocation::with('studyMode', 'module', 'academicIntake', 'academicYear', 'campus', 'user')->get();
        
        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        $users = User::where('user_type', 'Staff')->selectRaw('concat(first_name, concat(" ", last_name)) as teaching_staff_name, id')->orderBy('first_name')->pluck('teaching_staff_name', 'id')->all();
        
        return view('pages.assessments.module_allocations.index', compact('moduleAllocations','studyModes', 'academicYears', 'campuses', 'academicIntakes', 'modules', 'users', 'filterData'));
    }

    private function applyFilters($moduleAllocations, $filterData)
    {

        if (isset($filterData['academic_year'])) {
            $moduleAllocations = $moduleAllocations->where('academic_year_id', $filterData['academic_year']);
        }

        if (isset($filterData['academic_intake'])) {
            $moduleAllocations = $moduleAllocations->where('academic_intake_id', $filterData['academic_intake']);
        }

        if (isset($filterData['campus'])) {
            $moduleAllocations = $moduleAllocations->where('campus_id', $filterData['campus']);
        }

        if (isset($filterData['study_mode'])) {
            $moduleAllocations = $moduleAllocations->where('study_mode_id', $filterData['study_mode']);
        }

        if (isset($filterData['module'])) {
            $moduleAllocations = $moduleAllocations->where('module_id', $filterData['module']);
        }

        if (isset($filterData['user'])) {
            $moduleAllocations = $moduleAllocations->where('user_id', $filterData['user']);
        }

        return $moduleAllocations->get();
    }

    public function filteredApplications(Request $request)
    {

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        $users = User::where('user_type', 'Staff')->selectRaw('concat(first_name, concat(" ", last_name)) as teaching_staff_name, id')->orderBy('first_name')->pluck('teaching_staff_name', 'id')->all();

        $moduleAllocations = ModuleAllocation::with('studyMode', 'module', 'academicYear', 'academicIntake', 'campus', 'user');

        $filterData = $this->filterData($request);

        $moduleAllocations = $this->applyFilters($moduleAllocations, $filterData);

        return view('pages.assessments.module_allocations.index', compact('moduleAllocations','studyModes', 'academicYears', 'campuses', 'academicIntakes', 'modules', 'users', 'filterData'));
    }

    private function filterData($request)
    {
        $academic_year = session()->get('academic_year');
        $academic_intake = session()->get('academic_intake');
        $module = session()->get('module');
        $user = session()->get('user');
        $study_mode = session()->get('study_mode');
        $campus = session()->get('campus');

        if (count($request->all())) {

            session()->put('academic_year', $request->academic_year);
            session()->put('academic_intake', $request->academic_intake);
            session()->put('module', $request->module);
            session()->put('user', $request->user);
            session()->put('study_mode', $request->study_mode);
            session()->put('campus', $request->campus);

            return $request->all();
        } else {
            return [
                'academic_year' => $academic_year,
                'academic_intake' => $academic_intake,
                'module' => $module,
                'user' => $user,
                'study_mode' => $study_mode,
                'campus' => $campus,
            ];
        }
    }

    public function filter(Request $request)
    {

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        $users = User::where('user_type', 'Staff')->selectRaw('concat(first_name, concat(" ", last_name)) as teaching_staff_name, id')->orderBy('first_name')->pluck('teaching_staff_name', 'id')->all();

        $moduleAllocations = ModuleAllocation::with('studyMode', 'module', 'academicYear', 'academicIntake', 'campus', 'user');

        $filterData = $this->filterData($request);

        $moduleAllocations = $this->applyFilters($moduleAllocations, $filterData);


        return view('pages.assessments.module_allocations.index', compact('moduleAllocations', 'studyModes', 'academicYears', 'campuses', 'academicIntakes', 'modules', 'users', 'filterData'));
    }

    /**
     * Show the form for creating a new qualification.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        $users = User::where('user_type', 'Staff')->selectRaw('concat(first_name, concat(" ", last_name)) as teaching_staff_name, id')->orderBy('first_name')->pluck('teaching_staff_name', 'id')->all();

        return view('pages.assessments.module_allocations.create', compact('studyModes', 'academicYears', 'campuses', 'academicIntakes', 'modules', 'users'));
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

            $moduleAllocations = ModuleAllocation::where('academic_year_id', $data['academic_year_id'])
                ->where('campus_id', $data['campus_id'])
                ->where('study_mode_id', $data['study_mode_id'])
                ->where('user_id', $data['user_id'])
                ->where('module_id', $data['module_id'])
                ->whereIn('academic_intake_id', $data['academic_intake_id'])
                ->get();
                
            
            foreach ($data['academic_intake_id'] as $key => $academicIntakeId) {

                $moduleAllocation = $moduleAllocations->where('academic_intake_id', $academicIntakeId)->first();
                
                if(!$moduleAllocation){
                    ModuleAllocation::create([
                        'user_id' => $data['user_id'],
                        'academic_year_id' => $data['academic_year_id'],
                        'academic_intake_id' => $academicIntakeId,
                        'campus_id' => $data['campus_id'],
                        'study_mode_id' => $data['study_mode_id'],
                        'module_id' => $data['module_id'],
                    ]);
                }
            }

            return redirect()->route('assessments.module_allocations.index')
            ->with('success_message', 'Module allocation was successfully allocated to lecturer.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified qualification.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        $users = User::where('user_type', 'Staff')->selectRaw('concat(first_name, concat(" ", last_name)) as teaching_staff_name, id')->orderBy('first_name')->pluck('teaching_staff_name', 'id')->all();

        $moduleAllocation = ModuleAllocation::findOrFail($id);

        return view('pages.assessments.module_allocations.edit', compact('studyModes', 'academicYears', 'campuses', 'academicIntakes', 'modules', 'users', 'moduleAllocation'));
    }

    /**
     * Update the specified qualification in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {

            $data = $this->getData($request);

            $moduleAllocations = ModuleAllocation::where('academic_year_id', $data['academic_year_id'])
                ->where('campus_id', $data['campus_id'])
                ->where('study_mode_id', $data['study_mode_id'])
                ->where('user_id', $data['user_id'])
                ->where('module_id', $data['module_id'])
                ->delete();
            
            
            foreach ($data['academic_intake_id'] as $key => $academicIntakeId) {
                ModuleAllocation::create([
                    'user_id' => $data['user_id'],
                    'academic_year_id' => $data['academic_year_id'],
                    'academic_intake_id' => $academicIntakeId,
                    'campus_id' => $data['campus_id'],
                    'study_mode_id' => $data['study_mode_id'],
                    'module_id' => $data['module_id'],
                ]);
            }

            return redirect()->route('assessments.module_allocations.index')
            ->with('success_message', 'Module Allocation was successfully updated.');

        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
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
            $moduleAllocation = ModuleAllocation::findOrFail($id);
            $moduleAllocation->delete();

            return redirect()->route('assessments.module_allocations.index')
            ->with('success_message', 'Module allocation was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function copyView(){

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        return view('pages.assessments.module_allocations.copy', compact('academicYears'));
    }

    public function copy(Request $request){
        $rules = [
            'from_academic_year_id' => 'numeric|required',
            'to_academic_year_id' => 'numeric|required',
        ];

        $data = $request->validate($rules);

        if($data['from_academic_year_id'] >= $data['to_academic_year_id']){
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'From Academic Year cannot be greater than To Academic Year.']);
        }

        $fromData = ModuleAllocation::where('academic_year_id', $data['from_academic_year_id'])->get();

        ModuleAllocation::where('academic_year_id', $data['to_academic_year_id'])->delete();
        
        foreach($fromData as $from){
            ModuleAllocation::create([
                'user_id' => $from->user_id,
                'academic_year_id' => $data['to_academic_year_id'],
                'academic_intake_id' => $from->academic_intake_id,
                'campus_id' => $from->campus_id,
                'study_mode_id' => $from->study_mode_id,
                'module_id' => $from->module_id,
            ]);
        }

        return redirect()->route('assessments.module_allocations.index')
        ->with('success_message', 'Module allocation was successfully copied to the specified year.');
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
            'academic_year_id' => 'numeric|required',
            'academic_intake_id' => 'array|required',
            'campus_id' => 'required',
            'study_mode_id' => 'required',
            'user_id' => 'required',
            'module_id' => 'required',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
