<table class="table table-row-dashed table-rounded border">
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered" style="width:300px;">{{ __('Company Name') }}</th>
        <td>{{ $application->userInfo->employment->company_name }}</td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Position') }}</th>
        <td>{{ $application->userInfo->employment->position }}</td>
        </td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Department') }}</th>
        <td>{{ $application->userInfo->employment->department }}</td>
    </tr>

    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Company Address') }}</th>
        <td>{{ $application->userInfo->employment->company_address }} </td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Work Contact Number') }}</th>
        <td>{{ $application->userInfo->employment->work_contact_number }}</td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Work Email') }}</th>
        <td>{{ $application->userInfo->employment->work_email }}</td>
    </tr>
</table>