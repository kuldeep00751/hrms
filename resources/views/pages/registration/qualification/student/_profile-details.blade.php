<table class="table table-row-dashed table-rounded border">
        <tr>
            <th class="text-start text-gray-400 fw-bold text-uppercase p-3 table-row-bordered table-row-dashed" style="width:300px;">{{ __('Photo') }}</th>
            <td>
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    <img src="{{ asset('storage/'.$application->userInfo->passport_photo) }}" alt="image" />
                </div>
            </td>
        </tr>
        <tr>
            <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Full name') }}</th>
            <td>{{ $application->userInfo->title->title }} {{ $application->userInfo->first_names }} {{ $application->userInfo->surname }}</td>
        </tr>
        <tr>
            <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Maiden Name') }}</th>
            <td>{{ $application->userInfo->maiden_name }} </td>
        </tr>
        <tr>
            <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Gender') }}</th>
            <td>{{ $application->userInfo->gender->gender_type }}</td>
        </tr>

        <tr>
            <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Date of Birth') }}</th>
            <td>{{ $application->userInfo->date_of_birth }} </td>
        </tr>
        <tr>
            <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('National ID Number') }}</th>
            <td>{{ $application->userInfo->id_number }}</td>
        </tr>
        <tr>
            <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Mobile Number') }}</th>
            <td>{{ $application->userInfo->mobile_number }}</td>
        </tr>
        <tr>
            <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Email Address') }}</th>
            <td>{{ $application->userInfo->citizenship_status }}</td>
        </tr>
    </table>