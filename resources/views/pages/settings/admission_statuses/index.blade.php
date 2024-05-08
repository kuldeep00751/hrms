<x-base-layout>
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <a href="/system/settings" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                </div>
                <div class="pull-right">
                    <a href="{{ route('admission_statuses.admission_status.create') }}" class="btn btn-sm btn-primary" admissionStatus="Create New Academic Intake">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                </div>
            </div>

            @if(count($admissionStatuses) == 0)
            <div class="card-body text-center">
                <h4>No Admission Status Available.</h4>
            </div>
            @else
            <div class="card-body pt-6">
                @if(Session::has('success_message'))
                <div class="alert alert-success">
                    <h6 class="text-success">
                        <i class="fa-solid fa-circle-check text-success"></i>
                        {!! session('success_message') !!}
                    </h6>
                </div>
                @endif
                <div class="table-responsive">

                    <table class="table table-row-dashed">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                <th>Order</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Full Admission (Yes/No)</th>
                                <th>Active</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admissionStatuses as $admissionStatus)
                            <tr>
                                <td>{{ $admissionStatus->order }}</td>
                                <td>{{ $admissionStatus->status }}</td>
                                <td>{{ $admissionStatus->description }}</td>
                                <td>{{ ($admissionStatus->full_admission == 1) ? "Yes" : "No" }}</td>
                                <td>
                                    <!--begin::Switch-->
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input status-toggle" data-id="{{ $admissionStatus->id }}" type="checkbox" value="{{ $admissionStatus->active }}" {{ ($admissionStatus->active == 1) ? "checked" : ""}} />
                                    </label>
                                    <!--end::Switch-->
                                </td>
                                <td>
                                    <a href="{{ route('admission_statuses.admission_status.edit', $admissionStatus->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                {!! $admissionStatuses->render() !!}
            </div>

            @endif

        </div>
    </div>

    {{ csrf_field() }}
    <script>
        let statusToggles = document.querySelectorAll('.status-toggle');

        statusToggles.forEach(function(statusToggle) {
            statusToggle.addEventListener('change', function() {

                let modelId = statusToggle.dataset.id

                let data = {
                    id: statusToggle.dataset.id,
                    active: (statusToggle.checked) ? 1 : 0,
                    '_token': document.getElementsByName("_token")[0].value
                }
                const url = 'admission_statuses/update-status'

                const response = fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
            })
        })
    </script>
</x-base-layout>