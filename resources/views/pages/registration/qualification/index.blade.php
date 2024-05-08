<x-base-layout>
    <div class="col-md-12 mx-auto mb-5">
        <div class="col-md-12 mb-5">

            <div class="bg-white p-5">
                <form method="GET" action="{{ route('registration.qualification.filter') }}" accept-charset="UTF-8" class="form-horizontal">
                    <div class="fv-row">
                        <!--begin::Label-->
                        <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Student number:') }}</label>
                        <!--end::Label-->
                        <div class="form-group {{ $errors->has('student_number') ? 'has-error' : '' }}">
                            <div class="col-md-12">
                                <input class="form-control" name="student_number" type="number" id="student_number" value="{{ old('student_number', $filterData['student_number'] ?? '') }}" placeholder="Enter student number here...">
                            </div>
                        </div>

                    </div>
                    <div class="separator separator-dashed mx-5 my-5"></div>

            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9 bg-white">
                <a href="{{ route('registration.qualification.index') }}" class="btn btn-white btn-active-light-primary me-2">{{ __('Reset') }}</a>

                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                    {{ __('Search') }}
                </button>
            </div>
            </form>
        </div>
        <div class="col-md-12 mx-auto">
            @if(count($registrations) == 0)
            <div class="card">
                <div class="card-header">
                    <h3>Qualification Registrations</h3>
                </div>
                <div class="card-body text-center">
                    <div class="alert alert-danger">
                        No application information found. Please refine your search above
                    </div>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header">

                    <div class="pull-left">
                        <h3>Qualification Registrations</h3>
                    </div>
                    <div class="pull-right">
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <!--begin::Export dropdown-->
                            <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="fa-solid fa-download"></i>
                                Download Applications
                            </button>
                            <!--begin::Menu-->
                            <div id="kt_datatable_example_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-export="copy">
                                        Copy to clipboard
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-export="excel">
                                        Export as Excel
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-export="csv">
                                        Export as CSV
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-export="pdf">
                                        Export as PDF
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                            <!--end::Export dropdown-->

                            <!--begin::Hide default export buttons-->
                            <div id="kt_datatable_example_buttons" class="d-none"></div>
                            <!--end::Hide default export buttons-->
                        </div>
                    </div>
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
                        {{ $error }}
                        @endforeach
                    </ul>
                    @endif
                    <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="table-responsive">

                            <table class="table table-row-dashed nowrap" id="kt_datatable_example" style="font-size: 12px;">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                        <th>Student Number</th>
                                        <th>Student Name</th>
                                        <th>Year</th>
                                        <th>Intake</th>
                                        <th>Qualification</th>
                                        <th>Campus</th>
                                        <th>Registration Status</th>
                                        <th>Promotion Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registrations as $registration)
                                    <tr>
                                        <td>{{ $registration->userInfo->student_number }}</td>
                                        <td>{{ $registration->userInfo->first_names }} {{ $registration->userInfo->surname }}</td>
                                        <td>{{ $registration->academicYear->name }}</td>
                                        <td>{{ $registration->academicIntake->name }}</td>
                                        <td>{{ $registration->qualification->qualification_name }}</td>
                                        <td>{{ $registration->campus->name }}</td>
                                        <td>{{ $registration->registrationStatus->status ?? "Pending" }}</td>
                                        <td>{!! $registration->promotionStatus->description ?? '<span class="badge badge-danger">Not Promoted</span>' !!}</td>
                                        <td>
                                            <a href="{{ route('registration.qualification.show', [$registration->id]) }}" class="btn btn-sm btn-light btn-active-light-primary" title="Show Info">Show</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
</x-base-layout>