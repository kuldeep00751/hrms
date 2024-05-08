<x-base-layout>
    <div class="col-md-12">

        <div class="card">
            <div class="card">

                <div class="card-header">

                    <div class="pull-left">
                        <a href="/system/settings#academic_structure" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                    </div>

                    <div class="pull-right" role="group">
                        <a href="{{ route('qualifications.qualification.create') }}" class="btn btn-sm btn-primary" title="Create New Qualification">
                            <i class="fa-solid fa-plus"></i> Add New
                        </a>
                    </div>

                </div>

                @if(count($qualifications) == 0)
                <div class="card-body text-center">
                    <h4>No Qualifications Available.</h4>
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
                                    <th>Qualification Name</th>
                                    <th>Qualification Code</th>
                                    <th>Qualification Level</th>
                                    <th>No. of years</th>
                                    <th>NQF level</th>
                                    <th>Credits</th>
                                    <th>Active</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($qualifications as $qualification)
                                <tr>
                                    <td>{{ $qualification->qualification_name }}</td>
                                    <td>{{ $qualification->qualification_code }}</td>
                                    <td>{{ optional($qualification->qualificationType)->application_type }}</td>
                                    <td>{{ optional($qualification->numberOfYears)->year_level }}</td>
                                    <td>{{ optional($qualification->nqfLevel)->nqf_level }}</td>
                                    <td>{{ $qualification->qualification_credits }}</td>
                                    <td>
                                        <!--begin::Switch-->
                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input status-toggle" data-id="{{ $qualification->id }}" type="checkbox" value="{{ $qualification->active }}" {{ ($qualification->active == 1) ? "checked" : ""}} />
                                        </label>
                                        <!--end::Switch-->
                                    </td>

                                    <td>
                                        <a href="{{ route('qualifications.qualification.edit', $qualification->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
                                        <a href="{{ route('qualifications.qualification.show', $qualification->id ) }}" class="btn btn-sm btn-light btn-active-light-primary" title="Show Qualification">
                                            Show
                                        </a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
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
                    const url = 'qualifications/update-status'

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
    </div>
</x-base-layout>