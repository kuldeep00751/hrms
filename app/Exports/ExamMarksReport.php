<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExamMarksReport implements FromView
{

    public function view(): View
    {
        $moduleAllocation = session()->get('moduleAllocation');
        $moduleRegistrations = session()->get('moduleRegistrations');
        $examModulePaper = session()->get('examModulePaper');
        $studentExaminations = session()->get('studentExaminations');
        $examPapers = session()->get('examPapers');
        $assessmentType = session()->get('assessmentType');

        return view('pages.assessments.examinations.exam_report', compact('moduleAllocation', 'moduleRegistrations', 'examModulePaper', 'studentExaminations', 'examPapers', 'assessmentType'));
    }
}
