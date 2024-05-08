<?php

namespace App\Http\Controllers;

use App\Exports\Classlist;
use App\Models\ModuleAllocation;
use App\Models\ModuleRegistration;
use Excel;
use Illuminate\Http\Request;

class LecturerModulesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = auth()->user();

        $lecturerModules = ModuleAllocation::with('module')->where('user_id', $user->id)->get();

        return view('pages.assessments.my_modules.index', compact('lecturerModules'));
    }

    public function viewClasslist($moduleAllocation) {

        $moduleAllocation = ModuleAllocation::with('module')->find($moduleAllocation);

        $moduleRegistrations = ModuleRegistration::with('userInfo', 'academicYear', 'academicIntake', 'studyMode', 'campus')
                                                ->where('academic_year_id', $moduleAllocation->academic_year_id)
                                                ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
                                                ->where('campus_id', $moduleAllocation->campus_id)
                                                ->where('study_mode_id', $moduleAllocation->study_mode_id)
                                                ->where('module_id', $moduleAllocation->module_id)
                                                ->orderBy('user_info_id')
                                                ->get();
        
        return view('pages.assessments.my_modules.classlist', compact('moduleRegistrations', 'moduleAllocation'));
    }

    public function downloadClasslist($moduleAllocation) {

        $moduleAllocation = ModuleAllocation::with('module')->find($moduleAllocation);

        $moduleRegistrations = ModuleRegistration::with('userInfo', 'academicYear', 'academicIntake', 'studyMode', 'campus')
                                                ->where('academic_year_id', $moduleAllocation->academic_year_id)
                                                ->where('academic_intake_id', $moduleAllocation->academic_intake_id)
                                                ->where('campus_id', $moduleAllocation->campus_id)
                                                ->where('study_mode_id', $moduleAllocation->study_mode_id)
                                                ->where('module_id', $moduleAllocation->module_id)
                                                ->get();

        $moduleRegistration = $moduleRegistrations->first();

        $filename = $moduleRegistration->module->module_name."_". $moduleRegistration->academicYear->name;

        session()->put('moduleAllocation', $moduleAllocation);
        session()->put('moduleRegistrations', $moduleRegistrations);

        return Excel::download(new Classlist, $filename.''. '.xlsx');
    }


}
