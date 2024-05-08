<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CaReport implements FromView
{

    public function view(): View
    {
        $moduleRegistrations = session()->get('moduleRegistrations');

        $caMarkTypes = session()->get('caMarkTypes');

        $studentCas = session()->get('studentCas');

        $continuousAssessmentWeights = session()->get('continuousAssessmentWeights');

        return view('pages.assessments.continuous_assessments.ca_report', compact('moduleRegistrations', 'caMarkTypes', 'continuousAssessmentWeights', 'studentCas'));
    }
}
