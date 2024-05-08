<x-base-layout>
    <div class="col-md-6 mx-auto">

        <div class="card">

            <div class="card-header">

                <div class="pull-left">
                    <a href="/system/settings" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                </div>

                <div class="pull-right">
                    <a href="{{ route('student_types.student_type.create') }}" class="btn btn-sm btn-primary" title="Create New Student Type">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                </div>

            </div>

            @if(count($studentTypes) == 0)
            <div class="card-body text-center">
                <h4>No Student Types Available.</h4>
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
                                <th>Student Type</th>
                                <th>Active</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studentTypes as $studentType)
                            <tr>
                                <td>{{ $studentType->student_type }}</td>
                                <td>
                                    <!--begin::Switch-->
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input status-toggle" data-id="{{ $studentType->id }}" type="checkbox" value="{{ $studentType->active }}" {{ ($studentType->active == 1) ? "checked" : ""}} />
                                    </label>
                                    <!--end::Switch-->
                                </td>

                                <td>
                                    <a href="{{ route('student_types.student_type.edit', $studentType->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="panel-footer">
                {!! $studentTypes->render() !!}
            </div>

            @endif

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
                    const url = 'student_types/update-status'

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