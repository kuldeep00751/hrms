<x-base-layout>
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">

                <div class="pull-left">
                    <a href="{{ route('assessments.attendance_register.index', $moduleAllocation->id) }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Attendance Registers </a>
                </div>
                <div class="pull-right">
                    <h3>Update Attendance Register</h3>
                </div>
            </div>
            <form method="post" action="{{ route('assessments.attendance_register.update', $attendanceRegister->id) }}">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
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

                    {{ csrf_field() }}
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
                                        <th> <input class="form-check-input border border-primary" type="checkbox" id="header-checkbox" /> Select</th>
                                        <th>Hours Attended</th>
                                        <th>Student Number</th>
                                        <th>First Name</th>
                                        <th>Surname</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($moduleRegistrations as $moduleRegistration)
                                    @php
                                    $attended = $attendanceRegister->userInfo->where('user_info_id', $moduleRegistration->user_info_id)->first();
                                    @endphp

                                    <tr>
                                        <td>
                                            <input class="form-check-input border border-primary column-checkbox" type="checkbox" name="user_info_id[]" value="{{$moduleRegistration->user_info_id}}" {{ ($attended) ? 'checked' : '' }} />
                                        </td>
                                        <td style="width: 200px; padding-right: 10px;">
                                            <input class="form-control col-md-6" name="attendance_duration[{{$moduleRegistration->user_info_id}}]" type="number" id="attendance_duration" value="{{ ($attended) ? $attended->attendance_duration : $moduleAllocation->module->lecture_duration }}">
                                            <input class="form-control" name="student_number[{{$moduleRegistration->user_info_id}}]" type="hidden" id="attendance_duration" value="{{ $moduleRegistration->userInfo->student_number }}">
                                            <input class="form-control" name="first_names[{{$moduleRegistration->user_info_id}}]" type="hidden" id="attendance_duration" value="{{ $moduleRegistration->userInfo->first_names }}">
                                            <input class="form-control" name="surname[{{$moduleRegistration->user_info_id}}]" type="hidden" id="attendance_duration" value="{{ $moduleRegistration->userInfo->surname }}">
                                        </td>
                                        <td>{{ $moduleRegistration->userInfo->student_number }}</td>
                                        <td>{{ $moduleRegistration->userInfo->first_names }}</td>
                                        <td>{{ $moduleRegistration->userInfo->surname }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <script>
                        // get the header checkbox element
                        const headerCheckbox = document.getElementById('header-checkbox');

                        // get all the checkboxes in the column
                        const columnCheckboxes = document.querySelectorAll('.column-checkbox');

                        // add an event listener to the header checkbox
                        headerCheckbox.addEventListener('change', function() {
                            // loop through all the checkboxes in the column
                            for (let i = 0; i < columnCheckboxes.length; i++) {
                                // check or uncheck each checkbox based on the header checkbox state
                                columnCheckboxes[i].checked = headerCheckbox.checked;
                            }
                        });
                    </script>
                </div>

                <div class="card-header">
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <a href="{{ route('assessments.attendance_register.index', $moduleAllocation->id) }}" class="btn btn-white btn-active-light-primary me-2">{{ __('Discard') }}</a>

                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                            {{ __('Save Changes') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>