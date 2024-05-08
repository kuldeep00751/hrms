<x-base-layout>
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <h3>My Modules</h3>
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

                @if(!count($lecturerModules))
                <div class="alert alert-danger">
                    You are not assigned to any module. Please contact your administrator.
                </div>
                @else
                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">

                        <table class="table table-row-dashed" id="kt_datatable_example">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Academic Year</th>
                                    <th>Module</th>
                                    <th>Module Code</th>
                                    <th>Intake</th>
                                    <th>Study Mode</th>
                                    <th>Campus</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lecturerModules as $lecturerModule)

                                <tr>
                                    <td>{{ $lecturerModule->academicYear->name }} </td>
                                    <td>{{ $lecturerModule->module->module_name }}</td>
                                    <td>{{ $lecturerModule->module->module_code }}</td>
                                    <td>{{ $lecturerModule->academicIntake->name }}</td>
                                    <td>{{ $lecturerModule->studyMode->study_mode }}</td>
                                    <td>{{ $lecturerModule->campus->name }}</td>
                                    <td>

                                        <!--begin::Action menu-->
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen052.svg-->
                                            <i class="bi bi-three-dots fs-3"></i> <!--end::Svg Icon-->
                                        </a>

                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase"><strong>Module Options</strong></div>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="{{route('assessments.my_modules.classlist', $lecturerModule->id)}}" class="menu-link px-3">View Class list</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="{{route('assessments.my_modules.download-classlist', $lecturerModule->id)}}" class="menu-link px-3">Download Class list</a>
                                            </div>

                                            <div class="menu-item px-3">
                                                <a href="{{ route('assessments.attendance_register.index', $lecturerModule->id) }}" class="menu-link px-3">Attendance Register</a>
                                            </div>

                                            <div class="menu-item px-3">
                                                <a href="{{ route('assessments.attendance_register.download_all', $lecturerModule->id) }}" class="menu-link px-3">Attendance Report</a>
                                            </div>

                                            <div class="menu-item px-3">
                                                <a href="{{ route('assessments.my_modules.class_notes', $lecturerModule->module_id) }}" class="menu-link px-3">Class notes</a>
                                            </div>
                                        </div>
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
    </div>
</x-base-layout>