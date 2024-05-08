@php
$moduleRegistration = $moduleRegistrations->first();
@endphp
<table style="width: 50%">
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Module Name</strong></th>
        <td>{{ $moduleRegistration->module->module_name }}</td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Module Code</strong></th>
        <td>{{ $moduleRegistration->module->module_code }}</td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Academic Year</strong></th>
        <td>{{ $moduleRegistration->academicYear->name }}</td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Academic Intake</strong></th>
        <td>{{ $moduleRegistration->academicIntake->name }}</td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Study Mode</strong></th>
        <td>{{ $moduleRegistration->studyMode->study_mode }}</td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Campus</strong></th>
        <td>{{ $moduleRegistration->campus->name }}</td>
    </tr>
</table>
<hr>
<table class="table table-row-dashed" id="kt_datatable_example">
    <thead>
        <tr class="text-start text-gray-400 fw-bold text-uppercase">
            <th nowrap><strong>Student Number</strong></th>
            <th nowrap><strong>First Names</strong></th>
            <th nowrap><strong>Surname</strong></th>
            <th nowrap><strong>Email</strong></th>
            <th nowrap><strong>Mobile number</strong></th>
        </tr>
    </thead>
    <tbody>
        @foreach($moduleRegistrations as $moduleRegistration)
        <tr>
            <td nowrap style="width: 100px">{{ $moduleRegistration->userInfo->student_number }} </td>
            <td nowrap style="width: 200px;">{{ $moduleRegistration->userInfo->first_names }} </td>
            <td nowrap style="width: 200px;">{{ $moduleRegistration->userInfo->surname }} </td>
            <td nowrap style="width: 200px;">{{ $moduleRegistration->userInfo->email_address }} </td>
            <td nowrap style="width: 200px;">{{ $moduleRegistration->userInfo->mobile_number }} </td>
        </tr>
        @endforeach
    </tbody>
</table>