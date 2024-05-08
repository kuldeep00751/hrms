<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ClassAttendanceRegisterLog implements FromView
{

    public function view(): View
    {
        $attendanceRegisters = session()->get('attendanceRegisters');

        $moduleAllocation = session()->get('moduleAllocation');

        $moduleRegistrations = session()->get('moduleRegistrations');

        return view('pages.assessments.my_modules.attendance_register.download_all', compact('attendanceRegisters', 'moduleAllocation', 'moduleRegistrations'));
    }
}
