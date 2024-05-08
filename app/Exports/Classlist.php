<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Classlist implements FromView
{

    public function view(): View
    {
        $moduleAllocation = session()->get('moduleAllocation');
        
        $moduleRegistrations = session()->get('moduleRegistrations');

        return view('pages.assessments.my_modules.download', [
            'moduleAllocation' => $moduleAllocation,
            'moduleRegistrations' => $moduleRegistrations
        ]);
    }
}
