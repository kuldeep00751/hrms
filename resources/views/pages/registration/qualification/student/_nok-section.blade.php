
    @foreach($application->userInfo->nextOfKin as $index => $nextOfKin)
    <table class="table table-row-dashed table-rounded border">
        <tr>
            <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered" style="width:300px;">{{ __('Full name') }}</th>
            <td>{{ $nextOfKin->nok_full_names }} ({{ $nextOfKin->relationship->relationship }}) </td>
        </tr>
        <tr>
            <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Contact') }}</th>
            <td>{{ $nextOfKin->nok_contact_number }}</td>
        </tr>
        <tr>
            <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('ID Number') }}</th>
            <td>{{ $nextOfKin->nok_id_number }}</td>
        </tr>

        <tr>
            <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Location and Address') }}</th>
            <td>{{ $nextOfKin->nok_address_line1 }} </td>
        </tr>
        <tr>
            <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Closest Town') }}</th>
            <td>{{ $nextOfKin->nok_town }}</td>
        </tr>
        <tr>
            <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Suburb / Village Name') }}</th>
            <td>{{ $nextOfKin->nok_suburb }}</td>
        </tr>
        <tr>
            <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Country') }}</th>
            <td>{{ $nextOfKin->country->name }}</td>
        </tr>
    </table>
    <div class="separator separator-dashed mx-5 my-5"></div>
    @endforeach
