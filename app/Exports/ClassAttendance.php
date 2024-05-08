<?php 

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ClassAttendance implements FromView
{

    public function view(): View
    {
        $attendanceRegister = session()->get('attendanceRegister');

        $moduleAllocation = session()->get('moduleAllocation');

        $moduleRegistrations = session()->get('moduleRegistrations');

        return view('pages.assessments.my_modules.attendance_register.download', compact('attendanceRegister', 'moduleAllocation', 'moduleRegistrations'));
    }
}