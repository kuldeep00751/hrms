<x-base-layout>
    <div class="col-md-6 mx-auto">

        <div class="card">

            <div class="card-header">
                <div class="pull-left">
                    <a href="/system/settings#academic_structure" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                </div>

                <div class="btn-group btn-group-sm pull-right">
                    <a href="{{ route('study_modes.study_mode.create') }}" class="btn btn-sm btn-primary" title="Create New Study Mode">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                </div>

            </div>

            @if(count($studyModes) == 0)
            <div class="card-body text-center">
                <h6>No Study Modes Available.</h6>
            </div>
            @else
            <div class="card-body">
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
                                <th>Study Mode</th>
                                <th>Active</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studyModes as $studyMode)
                            <tr>
                                <td>{{ $studyMode->study_mode }}</td>
                                <td>
                                    <!--begin::Switch-->
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input status-toggle" data-id="{{ $studyMode->id }}" type="checkbox" value="{{ $studyMode->active }}" {{ ($studyMode->active == 1) ? "checked" : ""}} />
                                    </label>
                                    <!--end::Switch-->
                                </td>
                                <td>
                                    <a href="{{ route('study_modes.study_mode.edit', $studyMode->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card-footer">
                {!! $studyModes->render() !!}
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
                const url = 'study_modes/update-status'

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