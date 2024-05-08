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
<div class="separator separator-dashed mx-5 my-5"></div>

<table class="table table-row-dashed table-striped table-hover" id="kt_datatable_example" style="width: 100%;">
    <thead>
        <tr class="text-start text-gray-400 fw-bold text-uppercase">
            <th><strong>Student Number</strong></th>
            <th><strong>First Name</strong></th>
            <th><strong>Surname</strong></th>
            @foreach($attendanceRegisters as $attendanceRegister)
            <th><strong>{{ date('d/m', strtotime($attendanceRegister->attendance_date)) }}</strong></th>
            @endforeach
            <th><strong>Total Hours</strong></th>
        </tr>
    </thead>
    <tbody>
        @foreach($moduleRegistrations as $moduleRegistration)

        @php
        $totalHours = 0;
        @endphp
        <tr>
            <td>{{ $moduleRegistration->userInfo->student_number }}</td>
            <td>{{ $moduleRegistration->userInfo->first_names }}</td>
            <td>{{ $moduleRegistration->userInfo->surname }}</td>
            @foreach($attendanceRegisters as $attendanceRegister)
            <td>
                @php
                $attended = $attendanceRegister->userInfo->where('user_info_id', $moduleRegistration->user_info_id)->first();
                @endphp
                @if($attended)
                P
                @php
                $totalHours += $attended->attendance_duration;
                @endphp
                @else
                A
                @endif
            </td>
            @endforeach
            <td>{{ $totalHours }}</td>
        </tr>
        @endforeach
    </tbody>
</table>