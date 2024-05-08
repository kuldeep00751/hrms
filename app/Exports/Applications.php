<?php

namespace App\Exports;

use App\Models\Application;
use App\Models\HealthQuestionnaire;
use App\Models\RequiredDocument;
use App\Models\StudentDocument;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;



class Applications implements FromView, ShouldAutoSize, WithEvents, ShouldQueue
{
    use Exportable;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {

      
        $applications = Application::with('userInfo', 'academicYear', 'academicIntake', 'campus', 'studyMode', 'qualification', 'applicationType')
                                    ->where('academic_year_id', $this->data['academic_year'])
                                    ->where('application_type_id', $this->data['application_type'])
                                    ->where('academic_intake_id', $this->data['academic_intake'])
                                    ->where('campus_id', $this->data['campus'])
                                    ->where('qualification_id', $this->data['qualification'])
                                    ->get();


        $requiredDocuments = RequiredDocument::all();

        $healthQuestionnaires = HealthQuestionnaire::whereIn('user_info_id', $applications->pluck('user_info_id', 'user_info_id'))->get();

        $studentDocuments = StudentDocument::whereIn('user_info_id', $applications->pluck('user_info_id', 'user_info_id'))->get();

        return view('pages.admission.applications.download', [
            'applications' => $applications,
            'requiredDocuments' => $requiredDocuments,
            'healthQuestionnaires' => $healthQuestionnaires,
            'studentDocuments' => $studentDocuments
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A2:AH2'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);

            },
        ];
    }
}