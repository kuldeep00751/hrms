<x-base-layout>
    <div class="col-md-12 mx-auto mb-5">

        <div class="card">
            <div class="card-header">
                <h3>Filter Student Registration: </h3>
            </div>
            <form method="POST" action="{{ route('module-management.filter') }}" accept-charset="UTF-8" class="form-horizontal">
                {{ csrf_field() }}
                <div class="card-body">

                    <div class="row mb-5">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label fw-bold fs-6 text-right required">{{ __('Student Number') }}</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <input class="form-control" name="student_number" type="number" value="{{ request()->student_number }}" required>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label fw-bold fs-6 text-right required">{{ __('Academic Year') }}</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <select name="academic_year_id" aria-label="{{ __('Academic Year') }}" data-placeholder="{{ __('Select academic year...') }}" data-control="select2" class="form-select form-select-solid fw-bold" required>
                                <option value="" style="display: none;" disabled selected>Select Academic Year</option>
                                @foreach ($academicYears as $key => $academicYear)
                                @if(isset(request()->academic_year_id))
                                <option value="{{ $key }}" {{ old('academic_year', request()->academic_year_id) == $key ? 'selected' : '' }}>
                                    @else
                                <option value="{{ $key }}">
                                    @endif
                                    {{ $academicYear }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('registration.modules.module-management') }}" class="btn btn-active-light-primary me-2">{{ __('Reset') }}</a>

                    <button type="submit" class="btn btn-primary">
                        {{ __('Search') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12">
        @if(count($moduleRegistration))
        <div class="card mb-5">
            <div class="card-header">
                <div class="pull-left">
                    <strong>Student Details</strong>
                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    @php
                    $userInfo = $moduleRegistration->first()->userInfo;
                    @endphp
                    <table class="table table-row-dashed" id="kt_datatable_example">
                        <thead>
                            <tr class="text-gray-400 fw-bold text-uppercase">
                                <th>Student Number</th>
                                <th>Surname</th>
                                <th>First Name</th>
                                <th>DOB</th>
                                <th>ID Number/Password</th>
                                <th>Citizenship Status</th>
                                <th>Contact Number</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $userInfo->student_number }}</td>
                                <td>{{ $userInfo->surname }} </td>
                                <td>{{ $userInfo->first_names }} </td>
                                <td>{{ $userInfo->date_of_birth }}</td>
                                <td>{{ $userInfo->id_number }}</td>
                                <td>{{ $userInfo->studentType->student_type }}</td>
                                <td>{{ $userInfo->mobile_number }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        @endif
        <div class="card">
            <div class="card-header">

                <div class="pull-left">
                    <strong>Module Registrations</strong>
                </div>
                @if(count($moduleRegistration))
                <div class="pull-right">
                    <a href="{{ route('registration.modules.add-module', [$userInfo->id, request()->academic_year_id]) }}" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-plus"></i> Add Module
                    </a>
                </div>
                @endif

            </div>
            <div class="card-body">
                @if(Session::has('success_message'))
                <div class="alert alert-success">
                    <h6 class="text-success">
                        <i class="fa-solid fa-circle-check text-success"></i>
                        {!! session('success_message') !!}
                    </h6>
                </div>
                @endif

                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <i class="fa-solid fa-circle-xmark text-danger"></i>
                    {!! $error !!}
                    @endforeach
                </ul>
                @endif
                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">

                        <table class="table table-row-dashed" id="kt_datatable_example">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Module Name</th>
                                    <th>Module Code</th>
                                    <th>Academic Year</th>
                                    <th>Academic Intake</th>
                                    <th>Study Mode</th>
                                    <th>Study Period</th>
                                    <th>Registration Status</th>
                                    <th>Exemption Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($moduleRegistration as $registration)
                                <tr>
                                    <td>{{ $registration->module->module_name }} </td>
                                    <td>{{ $registration->module->module_code }} </td>
                                    <td>{{ $registration->academicYear->name }}</td>
                                    <td>{{ $registration->academicIntake->name }}</td>
                                    <td>{{ $registration->studyMode->study_mode }}</td>
                                    <td>{{ $registration->studyPeriod->study_period }}</td>
                                    <td id="registration_status_{{$registration->id}}">{{ $registration->registrationStatus->status }}</td>
                                    <td id="exemption_status_{{$registration->id}}">
                                        @if($registration->is_exempted)
                                        Exempted
                                        @else
                                        Not-Exempted
                                        @endif
                                    </td>
                                    <td>
                                        <!--begin::Action menu-->
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen052.svg-->
                                            Module Action
                                            <!--end::Svg Icon-->
                                        </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            @if($registration->is_exempted)
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 remove-exemption-action-btn" data-id="{{ $registration->id }}" data-bs-toggle="modal" data-bs-target="#remove-exemption-modal">Remove Exemption</a>
                                            </div>
                                            @else
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 exemption-action-btn" data-id="{{ $registration->id }}" data-bs-toggle="modal" data-bs-target="#module-exemption-modal">Exempt Module</a>
                                            </div>
                                            @endif

                                            @if($registration->is_cancelled)
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 reverse-cancellation-action-btn" data-id="{{ $registration->id }}" data-bs-toggle="modal" data-bs-target="#reverse-cancellation-modal">Reverse Cancellation</a>
                                            </div>
                                            @else
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 cancellation-action-btn" data-id="{{ $registration->id }}" data-bs-toggle="modal" data-bs-target="#module-cancellation-modal">Cancel Module</a>
                                            </div>
                                            @endif
                                        </div>
                                        <!--end::Menu-->
                                        <!--end::Action menu-->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-dialog-scrollable" tabindex="-1" id="module-exemption-modal" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Exempt Module</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>
                <form method="POST" action="{{ route('registration.modules.exempt') }}" accept-charset="UTF-8" class="form-horizontal" onsubmit="event.preventDefault(); submitModuleExemptionRequest();">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="alert alert-danger d-none" id="errorExemptMessage">

                        </div>
                        <div class="alert alert-success d-none" id="successExemptMessage">

                        </div>
                        <div class="mb-5 form-group">
                            <label for="document_name" class="col-md-6 control-label required mb-1"><strong>Exemption Reason</strong></label>
                            <div class="col-md-12">
                                <textarea class="form-control" type="text" id="exemption_reason" name="exemption_reason"></textarea>
                                <input class="form-control" type="hidden" id="exemption_id" name="module_registration_id" value="">
                            </div>
                        </div>

                    </div>

                    <div class=" modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Process Exemption</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade modal-dialog-scrollable" tabindex="-1" id="module-cancellation-modal" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Cancel Module</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>
                <form method="POST" action="{{ route('registration.modules.cancel') }}" accept-charset="UTF-8" class="form-horizontal" id="cancellation-form" onsubmit="event.preventDefault(); submitModuleCancellationRequest();">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="alert alert-danger d-none" id="errorMessage">

                        </div>
                        <div class="alert alert-success d-none" id="successMessage">

                        </div>
                        <div class="mb-5 form-group">
                            <label for="cancellation_date" class="col-md-6 control-label required mb-1"><strong>Cancellation Date</strong></label>
                            <div class="col-md-12">
                                <input class="form-control" type="date" id="cancellation_date" name="cancellation_date" value="">
                                <div class="help-block alert alert-info mt-2">
                                    <strong><i class="fa-solid fa-circle-info text-info"></i></strong> For backdated cancellations, please change the date above to the cancellation period.
                                </div>
                            </div>
                        </div>
                        <div class="mb-5 form-group">
                            <label for="document_name" class="col-md-6 control-label required mb-1"><strong>Cancellation Reason</strong></label>
                            <div class="col-md-12">
                                <textarea class="form-control" type="text" id="cancellation_reason" name="cancellation_reason"></textarea>
                                <input class="form-control" type="hidden" id="cancel_id" name="module_registration_id" value="">
                            </div>
                        </div>
                    </div>

                    <div class=" modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Process Cancellation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade modal-dialog-scrollable" tabindex="-1" id="reverse-cancellation-modal" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Reverse Cancellation</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>
                <form method="POST" action="{{ route('registration.modules.cancel') }}" accept-charset="UTF-8" class="form-horizontal" onsubmit="event.preventDefault(); submitReverseCancellationRequest();">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="alert alert-info mt-2">
                            <strong><i class="fa-solid fa-circle-info text-info"></i></strong> Please make sure the module fees are defined before you proceed. All previous cancellation credits will be reversed and a module fee amount will be applied again.
                        </div>
                        <input type="hidden" name="module_registration_id" id="module_registration_id" value="">
                    </div>

                    <div class=" modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Reverse Cancellation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade modal-dialog-scrollable" tabindex="-1" id="remove-exemption-modal" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Exemption</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>
                <form method="POST" action="#" accept-charset="UTF-8" class="form-horizontal" onsubmit="event.preventDefault(); submitRemoveExemptionRequest();">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="alert alert-info mt-2">
                            <strong><i class="fa-solid fa-circle-info text-info"></i></strong> Please make sure the module fees are defined before you proceed. All previous cancellation credits will be reversed and a module fee amount will be applied again.
                        </div>
                        <input type="hidden" name="module_registration_id" id="module_exemption_id" value="">
                    </div>

                    <div class=" modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Remove Exemption</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let cancellationAction = document.querySelectorAll('.cancellation-action-btn');

        let exemptionAction = document.querySelectorAll('.exemption-action-btn');

        cancellationAction.forEach(function(action) {
            action.addEventListener('click', function(event) {

                let moduleRegistrationId = action.dataset.id;

                document.getElementById('cancel_id').value = moduleRegistrationId;

                let errorMessage = document.getElementById("errorMessage");
                let successMessage = document.getElementById("successMessage");
                let cancellationReason = document.getElementById("exemption_reason");

                errorMessage.classList.add('d-none');
                successMessage.classList.add('d-none');
                cancellationReason.value = "";

            })
        });

        let reverseCancellationAction = document.querySelectorAll('.reverse-cancellation-action-btn');

        reverseCancellationAction.forEach(function(action) {
            action.addEventListener('click', function(event) {

                let moduleRegistrationId = action.dataset.id;

                document.getElementById('module_registration_id').value = moduleRegistrationId;

            })
        });

        let removeExemptionActionBtn = document.querySelectorAll('.remove-exemption-action-btn');

        removeExemptionActionBtn.forEach(function(action) {
            action.addEventListener('click', function(event) {

                let moduleRegistrationId = action.dataset.id;

                document.getElementById('module_exemption_id').value = moduleRegistrationId;

            })
        });

        exemptionAction.forEach(function(action) {
            action.addEventListener('click', function(event) {

                let moduleRegistrationId = action.dataset.id;

                document.getElementById('exemption_id').value = moduleRegistrationId;

                let errorExemptMessage = document.getElementById("errorExemptMessage");
                let successExemptMessage = document.getElementById("successExemptMessage");
                let exemptionReason = document.getElementById("exemption_reason");

                errorExemptMessage.classList.add('d-none');
                successExemptMessage.classList.add('d-none');
                exemptionReason.value = "";

            })
        });

        async function submitModuleCancellationRequest() {
            let url = 'modules/cancel';

            let data = {
                'cancellation_reason': document.getElementById('cancellation_reason').value,
                'module_registration_id': document.getElementById('cancel_id').value,
                'cancellation_date': document.getElementById('cancellation_date').value,
                '_token': document.getElementsByName("_token")[0].value
            }

            const response = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data),
                }).then(response => response.json())
                .then(function(data) {


                    if (data.status == 0) {
                        errorMessage.innerHTML = `<strong>${data.message}</strong>`;
                        errorMessage.classList.remove('d-none');
                        successMessage.classList.add('d-none');
                    } else {
                        successMessage.innerHTML = `<strong>${data.message}</strong>`;
                        successMessage.classList.remove('d-none');
                        errorMessage.classList.add('d-none');
                        let registrationStatus = document.getElementById('registration_status_' + data.moduleRegistrationId)
                        registrationStatus.innerHTML = data.registrationStatus
                    }
                });

            return false;
        }

        async function submitModuleExemptionRequest() {
            let url = 'modules/exempt';

            let data = {
                'exemption_reason': document.getElementById('exemption_reason').value,
                'module_registration_id': document.getElementById('exemption_id').value,
                '_token': document.getElementsByName("_token")[0].value
            }

            const response = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data),
                }).then(response => response.json())
                .then(function(data) {

                    if (data.status == 0) {
                        errorExemptMessage.innerHTML = `<strong>${data.message}</strong>`;
                        errorExemptMessage.classList.remove('d-none');
                        successExemptMessage.classList.add('d-none');
                    } else {
                        successExemptMessage.innerHTML = `<strong>${data.message}</strong>`;
                        successExemptMessage.classList.remove('d-none');
                        errorExemptMessage.classList.add('d-none');
                        let exemptionStatus = document.getElementById('exemption_status_' + data.moduleRegistrationId)
                        exemptionStatus.innerHTML = data.exemptionStatus
                    }
                });

            return false;
        }

        async function submitReverseCancellationRequest() {

            let url = 'modules/reverse-cancellation';

            let data = {
                'module_registration_id': document.getElementById('module_registration_id').value,
                '_token': document.getElementsByName("_token")[0].value
            }

            const response = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data),
                }).then(response => response.json())
                .then(function(data) {

                    if (data.status == 0) {
                        Swal.fire(
                            "Error",
                            `${data.message}`,
                            "error"
                        );
                    } else {

                        let registrationStatus = document.getElementById('registration_status_' + data.moduleRegistrationId)
                        registrationStatus.innerHTML = data.registrationStatus
                        Swal.fire(
                            "Success",
                            `${data.message}`,
                            "success"
                        );
                    }
                });

            return false;
        }

        async function submitRemoveExemptionRequest() {

            let url = 'modules/remove-exemption';

            let data = {
                'module_registration_id': document.getElementById('module_exemption_id').value,
                '_token': document.getElementsByName("_token")[0].value
            }

            const response = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data),
                }).then(response => response.json())
                .then(function(data) {

                    if (data.status == 0) {
                        Swal.fire(
                            "Error",
                            `${data.message}`,
                            "error"
                        );
                    } else {

                        let exemptionStatus = document.getElementById('exemption_status_' + data.moduleRegistrationId)
                        exemptionStatus.innerHTML = data.exemptionStatus
                        Swal.fire(
                            "Success",
                            `${data.message}`,
                            "success"
                        );
                    }
                });

            return false;
        }
    </script>
</x-base-layout>