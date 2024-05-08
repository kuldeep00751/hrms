@foreach($application->userInfo->previousQualification as $index => $previousQualification)
<table class="table table-row-dashed table-rounded border">
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered" style="width:300px;">{{ __('Level') }}</th>
        <td>{{ $previousQualification->level->application_type }} </td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Student Number') }}</th>
        <td>{{ $previousQualification->student_number }}</td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Institution / University name') }}</th>
        <td>{{ $previousQualification->institution }}</td>
    </tr>

    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Qualification name') }}</th>
        <td>{{ $previousQualification->qualification_name }} </td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Has this qualification been awarded (Yes/No)') }}</th>
        <td>{{ ($previousQualification->awarded_yn == 1) ? "Yes" : "No" }}</td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Period') }}</th>
        <td>{{ $previousQualification->from_date }} - {{ $previousQualification->to_date }}</td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Uploaded Documents') }}</th>
        <td></td>
    </tr>
</table>
<div class="separator separator-dashed mx-5 my-5"></div>
@endforeach