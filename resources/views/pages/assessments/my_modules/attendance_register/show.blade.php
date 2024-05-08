<x-base-layout>
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">

                <div class="pull-left">
                    <a href="{{ route('assessments.attendance_register.index', $moduleAllocation->id) }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Attendance Registers </a>
                </div>
                <div class="pull-right">
                    <h3>Show Attendance Register</h3>
                </div>
            </div>
            <div class="card-body">

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
                <div class="separator separator-dashed mx-5 my-5"></div>

                <div class="row mb-10">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('attendance_date') ? 'has-error' : '' }}">
                            <label for="attendance_date" class="control-label">Attendance Date <span class="text-danger">*</span></label>
                            <input class="form-control" name="attendance_date" type="date" id="attendance_date" value="{{ old('attendance_date', optional($attendanceRegister)->attendance_date) }}" required>
                            <input class="form-control" name="module_id" type="hidden" id="module_id" value="{{ $moduleAllocation->module_id }}">
                            <input class="form-control" name="academic_year_id" type="hidden" value="{{ $moduleAllocation->academic_year_id }}">
                            <input class="form-control" name="academic_intake_id" type="hidden" value="{{ $moduleAllocation->academic_intake_id }}">
                            <input class="form-control" name="study_mode_id" type="hidden" value="{{ $moduleAllocation->study_mode_id }}">
                            <input class="form-control" name="campus_id" type="hidden" value="{{ $moduleAllocation->campus_id }}">
                            <input class="form-control" name="module_allocation_id" type="hidden" value="{{ $moduleAllocation->id }}">
                        </div>
                    </div>
                </div>

                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-striped table-hover" id="kt_datatable_example" style="width: 100%;">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Student Number</th>
                                    <th>First Name</th>
                                    <th>Surname</th>
                                    <th class="text-center">Hours Attended</th>
                                    <th class="text-center">Absent/Present </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($moduleRegistrations as $moduleRegistration)
                                @php
                                $attended = $attendanceRegister->userInfo->where('user_info_id', $moduleRegistration->user_info_id)->first();
                                @endphp

                                <tr>
                                    <td>{{ $moduleRegistration->userInfo->student_number }}</td>
                                    <td>{{ $moduleRegistration->userInfo->first_names }}</td>
                                    <td>{{ $moduleRegistration->userInfo->surname }}</td>
                                    <td class="text-center">{{ ($attended) ? $attended->attendance_duration : 0 }}</td>
                                    <td class="text-center">
                                        @if($attended)
                                        <i class="fas fa-check-circle text-success"></i>
                                        @else
                                        <i class="fas fa-circle-xmark text-danger"></i>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card-header">
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('assessments.attendance_register.index', $moduleAllocation->id) }}" class="btn btn-white btn-active-light-primary me-2">{{ __('Back') }}</a>
                </div>
            </div>
        </div>
    </div>
</x-base-layout>