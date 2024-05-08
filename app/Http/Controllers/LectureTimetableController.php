<?php

namespace App\Http\Controllers;

use App\Models\AcademicIntake;
use App\Models\AcademicYear;
use App\Models\Campus;
use App\Models\Module;
use App\Models\Qualification;
use App\Models\Space;
use App\Models\StudyMode;
use App\Models\StudyPeriod;
use App\Models\User;
use Illuminate\Http\Request;

class LectureTimetableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $campuses = Campus::where('active', 1)->pluck('name', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::pluck('name', 'id')->all();

        $studyModes = StudyMode::where('active', 1)->pluck('study_mode', 'id')->all();

        $studyPeriods = StudyPeriod::where('active', 1)->pluck('study_period', 'id')->all();

        $modules = Module::where('active', 1)->pluck('module_name', 'id')->all();

        $spaces = Space::where('active', 1)->pluck('name', 'id')->all();

        $qualifications = Qualification::where('active', 1)->pluck('qualification_name', 'id')->all();

        $users = User::where('user_type', 'Staff')->selectRaw('concat(first_name, concat(" ", last_name)) as teaching_staff_name, id')->orderBy('first_name')->pluck('teaching_staff_name', 'id')->all();
        
        return view('pages.timetables.lecture.index', compact('campuses', 'academicYears', 'academicIntakes', 'studyModes', 'studyPeriods', 'modules', 'qualifications', 'users', 'spaces'));
    }
}
