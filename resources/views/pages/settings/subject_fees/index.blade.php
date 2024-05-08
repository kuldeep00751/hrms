<x-base-layout>
    <div class="col-md-12">

        <div class="card">
            <div class="card">

                <div class="card-header">

                    <div class="pull-left">
                        <a href="/system/settings#finance" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                    </div>

                    <div class="pull-right" role="group">
                        <a href="{{ route('subjectFees.subjectFee.create') }}" class="btn btn-sm btn-primary" title="Create New Subject Fee">
                            <i class="fa-solid fa-plus"></i> Add New
                        </a>
                        <a href="{{route('subjectFees.subjectFee.copyForm')}}" class="btn btn-sm btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="fa-solid fa-copy"></i>
                            Copy Subject Fees
                        </a>
                    </div>

                </div>

                @if(count($subjectFees) == 0)
                <div class="card-body text-center">
                    <h4>No Subject Fees Available.</h4>
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

                        <table class="table table-row-dashed" id="kt_datatable_example">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Module Name</th>
                                    <th>Module Code</th>
                                    <th>Academic Year</th>
                                    <th>Student Type</th>
                                    <th>Assessment Type</th>
                                    <th>Amount (N$)</th>
                                    <th>Academic Process</th>
                                    <th>Active</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subjectFees as $subjectFee)
                                <tr>
                                    <td>{{ $subjectFee->module->module_name }}</td>
                                    <td>{{ $subjectFee->module->module_code }}</td>
                                    <td>{{ $subjectFee->academicYear->name }}</td>
                                    <td>{{ $subjectFee->studentType->student_type }}</td>
                                    <td>{{ optional($subjectFee->assessmentType)->assessment_type }}</td>
                                    <td>{{ number_format($subjectFee->amount,2,".",",") }}</td>
                                    <td>{{ $subjectFee->academic_process }}</td>
                                    <td>
                                        <!--begin::Switch-->
                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input status-toggle" data-id="{{ $subjectFee->id }}" type="checkbox" value="{{ $subjectFee->active }}" {{ ($subjectFee->active == 1) ? "checked" : ""}} />
                                        </label>
                                        <!--end::Switch-->
                                    </td>
                                    <td>
                                        <a href="{{ route('subjectFees.subjectFee.edit', $subjectFee->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
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
                    const url = 'subject_fees/update-status'

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