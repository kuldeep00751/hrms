<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FinalMarksReport implements FromView
{

    public function view(): View
    {
        $moduleAllocation = session()->get('moduleAllocation');
        $studentFinalMarks = session()->get('studentFinalMarks');
        $moduleRegistrations = session()->get('moduleRegistrations');
        $assessmentType = session()->get('assessmentType');

        return view('pages.assessments.final_marks.final_report', 
                    ['moduleAllocation' => $moduleAllocation,
                    'studentFinalMarks' => $studentFinalMarks,
                    'moduleRegistrations' => $moduleRegistrations,
                    'assessmentType' => $assessmentType]);
    }
}
