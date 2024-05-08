<table style="width: 50%">
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Module Name</strong></th>
        <td>{{ $moduleAllocation->module->module_name }}</td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Module Code</strong></th>
        <td>{{ $moduleAllocation->module->module_code }}</td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Exam Type</strong></th>
        <td>{{ $assessmentType->assessment_type }} ({{ $assessmentType->assessment_type_code }})</td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Academic Year</strong></th>
        <td>{{ $moduleAllocation->academicYear->name }}</td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Academic Intake</strong></th>
        <td>{{ $moduleAllocation->academicIntake->name }}</td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Study Mode</strong></th>
        <td>{{ $moduleAllocation->studyMode->study_mode }}</td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Campus</strong></th>
        <td>{{ $moduleAllocation->campus->name }}</td>
    </tr>
</table>

<table class="table table-striped table-row-bordered table-hover" id="kt_datatable_example">
    <thead>
        <tr class="text-start text-gray-800 fw-bold text-uppercase">
            <th>Student Number</th>
            <th>Surname</th>
            <th>Student Name</th>
            @foreach($examPapers as $examPaper)
            <th class="text-center">{{ $examPaper->paper_name }}</th>
            @endforeach
            <th class="text-center">Exam Mark</th>
        </tr>
    </thead>
    <tbody>
        @foreach($moduleRegistrations as $moduleRegistration)
        <tr>
            <td>{{$moduleRegistration->userInfo->student_number}}</td>
            <td>{{$moduleRegistration->userInfo->surname}}</td>
            <td>{{$moduleRegistration->userInfo->first_names}}</td>

            @foreach($examPapers as $examPaper)
            @php
            $mark = $examModulePaper->where('exam_paper_id', $examPaper->id)
            ->where('module_id', $moduleRegistration->module_id)
            ->where('user_info_id', $moduleRegistration->user_info_id)
            ->where('academic_year_id', $moduleRegistration->academic_year_id)
            ->where('academic_intake_id', $moduleRegistration->academic_intake_id)
            ->where('study_mode_id', $moduleRegistration->study_mode_id)
            ->where('assessment_type_id', $assessmentType->id)
            ->where('campus_id', $moduleRegistration->campus_id)
            ->first();
            @endphp
            <td class="text-center">{{ $mark->mark ?? 0}}</td>
            @endforeach
            <td class="text-center">
                @if($studentExaminations->where('user_info_id', $moduleRegistration->user_info_id)->first())
                {{ $studentExaminations->where('user_info_id', $moduleRegistration->user_info_id)->first()->exam_mark}}
                @else
                0
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>