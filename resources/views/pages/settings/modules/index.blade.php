<x-base-layout>
    <div class="col-md-12 mx-auto">

        <div class="card">

            <div class="card-header">

                <div class="pull-left">
                    <a href="/system/settings#academic_structure" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                </div>

                <div class="pull-right">
                    <a href="{{ route('modules.module.create') }}" class="btn btn-sm btn-primary" title="Create New Module">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                </div>

            </div>

            @if(count($modules) == 0)
            <div class="card-body text-center">
                <h4>No Modules Available.</h4>
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
                                <th>Module Code</th>
                                <th>Module Name</th>
                                <th>Level</th>
                                <th class="text-center">Lecture Duration</th>
                                <th class="text-center">Credits</th>
                                <th class="text-center">NQF Level</th>
                                <th>Active</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($modules as $module)
                            <tr>
                                <td>{{ $module->module_code }}</td>
                                <td>{{ $module->module_name }}</td>
                                <td>{{ $module->moduleLevel->application_type }}</td>
                                <td class="text-center">{{ $module->lecture_duration }}</td>
                                <td class="text-center">{{ $module->module_credits }}</td>
                                <td class="text-center">{{ $module->nqfLevel->nqf_level }}</td>
                                <td>
                                    <!--begin::Switch-->
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input status-toggle" data-id="{{ $module->id }}" type="checkbox" value="{{ $module->active }}" {{ ($module->active == 1) ? "checked" : ""}} />
                                    </label>
                                    <!--end::Switch-->
                                </td>
                                <td>
                                    <a href="{{ route('modules.module.edit', $module->id ) }}" class="btn btn-sm btn-light btn-active-light-primary" title="Edit Module">Edit</a>
                                    <a href="{{ route('modules.module.show', $module->id ) }}" class="btn btn-sm btn-light btn-active-light-primary" title="Show Module">Show</a>
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
                const url = 'modules/update-status'

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