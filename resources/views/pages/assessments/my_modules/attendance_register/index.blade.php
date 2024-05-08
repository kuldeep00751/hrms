<x-base-layout>
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">

                <div class="pull-left">
                    <a href="{{ route('assessments.my_modules.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> My Modules </a>
                </div>
                <div class="pull-left">
                    <h3>Attendance Register</h3>
                </div>
                <div class="pull-right">
                    <a href="{{ route('assessments.attendance_register.create', $moduleAllocation->id) }}" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                    <a href="{{ route('assessments.attendance_register.download_all', $moduleAllocation->id) }}" class="btn btn-sm btn-light btn-active-light-primary"><i class="fa-solid fa-download"></i> Download Attendance Report </a>
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

                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">
                        <table style="width: 50%">
                            <tr>
                                <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Module Name</strong></th>
                                <td>{{ $moduleAllocation->module->module_name }}</td>
                            </tr>
                            <tr>
                                <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Module Code</strong></th>
                                <td>{{ $moduleAllocation->module->module_code }}</td>
                            </tr>
                            <tr>
                                <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Academic Year</strong></th>
                                <td>{{ $moduleAllocation->academicYear->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Academic Intake</strong></th>
                                <td>{{ $moduleAllocation->academicIntake->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Study Mode</strong></th>
                                <td>{{ $moduleAllocation->studyMode->study_mode }}</td>
                            </tr>
                            <tr>
                                <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Campus</strong></th>
                                <td>{{ $moduleAllocation->campus->name }}</td>
                            </tr>
                        </table>
                        <hr>

                        <table class="table table-row-dashed" id="kt_datatable_example">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Date of Attendance</th>
                                    <th class="text-center">Present Students</th>
                                    <th class="text-center">Absent Students</th>
                                    <th>Recorded By</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attendanceRegisters as $attendanceRegister)
                                <tr>
                                    <td>{{ $attendanceRegister->attendance_date }} </td>
                                    <td class="text-center">{{ $attendanceRegister->userInfo->count() }}</td>
                                    <td class="text-center">{{ $moduleRegistrationCount - $attendanceRegister->userInfo->count() }}</td>
                                    <td>{{ $attendanceRegister->recordedBy->first_name }} {{ $attendanceRegister->recordedBy->last_name }}</td>

                                    <td>

                                        <!--begin::Action menu-->
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen052.svg-->
                                            <i class="bi bi-three-dots fs-3"></i> <!--end::Svg Icon-->
                                        </a>

                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase"><strong>Options</strong></div>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="{{route('assessments.attendance_register.edit', $attendanceRegister->id )}}" class="menu-link px-3">Edit Attendance</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="{{route('assessments.attendance_register.show', $attendanceRegister->id )}}" class="menu-link px-3">View Attendance</a>
                                            </div>

                                            <div class="menu-item px-3">
                                                <a href="{{ route('assessments.attendance_register.delete', $attendanceRegister->id ) }}" class="menu-link px-3" onclick="javascript:return confirm('Are you sure you want to delete this attendance register. This cannot be reversed.')">Delete Attendance</a>
                                            </div>

                                            <div class="menu-item px-3">
                                                <a href="{{ route('assessments.attendance_register.download_single', $attendanceRegister->id ) }}" class="menu-link px-3">Download Attendance</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="alert alert-info">
                                            No attendance has been recorded for this module.
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base-layout>