<x-base-layout>
    <div class="row">
        <div class="col-md-12 mb-5">

            <div class="bg-white p-5">
                <form method="POST" action="{{ route('assessments.exam_registration.filter') }}" accept-charset="UTF-8" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="row mb-2">
                        <!--begin::Col-->
                        <div class="col-4">
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase required">{{ __('Academic Year') }}</label>
                            <select name="academic_year" aria-label="{{ __('Academic Year') }}" data-placeholder="{{ __('Select academic year...') }}" data-control="select2" class="form-select form-select-solid fw-bold" required>
                                <option value="" style="display: none;" disabled selected>Select Academic Year</option>
                                @foreach ($academicYears as $key => $academicYear)
                                @if(isset($filterData['academic_year']))
                                <option value="{{ $key }}" {{ old('academic_year', $filterData['academic_year']) == $key ? 'selected' : '' }}>
                                    @else
                                <option value="{{ $key }}">
                                    @endif
                                    {{ $academicYear }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-4">
                            <!--begin::Label-->
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase required">{{ __('Academic Intake') }}</label>
                            <!--end::Label-->
                            <select name="academic_intake" aria-label="{{ __('Academic Intake') }}" data-placeholder="{{ __('Select academic intake...') }}" class="form-select form-select-solid fw-bold" required>
                                <option value="" style="display: none;" disabled selected>Select Academic Intake</option>
                                @foreach ($academicIntakes as $key => $academicIntake)
                                @if(isset($filterData['academic_intake']))
                                <option value="{{ $key }}" {{ old('academic_intake', $filterData['academic_intake']) == $key ? 'selected' : '' }}>
                                    @else
                                <option value="{{ $key }}">
                                    @endif
                                    {{ $academicIntake }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!--begin::Col-->
                        <div class="col-4">
                            <!--begin::Label-->
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase required">{{ __('Module') }}</label>
                            <!--end::Label-->
                            <select name="module" aria-label="{{ __('Module') }}" data-placeholder="{{ __('Select module...') }}" data-control="select2" class="form-select form-select-solid fw-bold" required>
                                <option value="" style="display: none;" disabled selected>Select Module</option>
                                @foreach ($modules as $key => $module)
                                @if(isset($filterData['module']))
                                <option value="{{ $key }}" {{ old('module', $filterData['module']) == $key ? 'selected' : '' }}>
                                    @else
                                <option value="{{ $key }}">
                                    @endif
                                    {{ $module }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <!--begin::Col-->
                        <div class="col-4">
                            <!--begin::Label-->
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase required">{{ __('Study Period') }}</label>
                            <!--end::Label-->
                            <select name="study_period" aria-label="{{ __('Study Period') }}" data-placeholder="{{ __('Select study period...') }}" data-control="select2" class="form-select form-select-solid fw-bold" required>
                                <option value="" style="display: none;" disabled selected>Select Qualification</option>
                                @foreach ($studyPeriods as $key => $studyPeriod)
                                @if(isset($filterData['study_period']))
                                <option value="{{ $key }}" {{ old('study_period', $filterData['study_period']) == $key ? 'selected' : '' }}>
                                    @else
                                <option value="{{ $key }}">
                                    @endif

                                    {{ $studyPeriod }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <!--begin::Label-->
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase required">{{ __('Study Mode') }}</label>
                            <!--end::Label-->
                            <select name="study_mode" aria-label="{{ __('Study Mode') }}" data-placeholder="{{ __('Select study mode...') }}" class="form-select form-select-solid fw-bold" required>
                                <option value="" style="display: none;" disabled selected>Select Study Mode</option>
                                @foreach ($studyModes as $key => $studyMode)
                                @if(isset($filterData['study_mode']))
                                <option value="{{ $key }}" {{ old('study_mode', $filterData['study_mode']) == $key ? 'selected' : '' }}>
                                    @else
                                <option value="{{ $key }}">
                                    @endif
                                    {{ $studyMode }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <!--begin::Col-->
                            <!--begin::Label-->
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase required">{{ __('Campus') }}</label>
                            <!--end::Label-->

                            <select name="campus" aria-label="{{ __('Campus') }}" data-placeholder="{{ __('Select campus...') }}" class="form-select form-select-solid fw-bold" required>
                                <option value="" style="display: none;" disabled selected>Select Campus</option>
                                @foreach ($campuses as $key => $campus)
                                @if(isset($filterData['campus']))
                                <option value="{{ $key }}" {{ old('campus', $filterData['campus']) == $key ? 'selected' : '' }}>
                                    @else
                                <option value="{{ $key }}">
                                    @endif
                                    {{ $campus }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="separator"></div>
                    <div class="row mb-2">
                        <!--begin::Col-->
                        <div class="col-12">
                            <!--begin::Label-->
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase required">{{ __('Select exam you wish to register students for') }}</label>
                            <!--end::Label-->
                            <select name="assessment_type_id" aria-label="{{ __('Assessment Type') }}" data-placeholder="{{ __('Select assessment type...') }}" class="form-select form-select-solid fw-bold" required>
                                <option value="" style="display: none;" disabled selected>Select assessment type</option>
                                @foreach ($assessmentTypes as $key => $assessmentType)
                                @if(isset($filterData['campus']))
                                <option value="{{ $key }}" {{ old('assessment_type_id', $filterData['assessment_type_id']) == $key ? 'selected' : '' }}>
                                    @else
                                <option value="{{ $key }}">
                                    @endif
                                    {{ $assessmentType }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <a href="{{ route('assessments.exam_registration.index') }}" class="btn btn-active-light-primary me-2">{{ __('Reset') }}</a>

                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                            {{ __('Search') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            @if(count($students) == 0)
            <div class="card">
                <div class="card-header">
                    <h3>Students</h3>
                </div>
                <div class="card-body text-center">
                    <div class="alert alert-danger">
                        There are no students available.
                    </div>
                </div>
            </div>
            @else
            <form method="post" action="{{ route('assessments.exam_registration.store') }}">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header">

                        <div class="pull-left">
                            <strong>Students</strong>
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

                        <input type="hidden" value="{{ $students->first()->module_id}}" name="module_id">
                        <input type="hidden" value="{{ $filterData['assessment_type_id']}}" name="assessment_type_id">
                        <input type="hidden" value="{{ $students->first()->academic_year_id}}" name="academic_year_id">
                        <input type="hidden" value="{{ $students->first()->study_mode_id}}" name="study_mode_id">
                        <input type="hidden" value="{{ $students->first()->academic_intake_id}}" name="academic_intake_id">
                        <input type="hidden" value="{{ $students->first()->campus_id}}" name="campus_id">

                        <div class="dataTables_wrapper dt-bootstrap4 no-footer">

                            <div class="table-responsive">

                                <table class="table table-hover table-bordered" id="kt_datatable_example" style="font-size: 12px; cursor: pointer;">
                                    <thead>
                                        <tr class="text-gray-400 fw-bold text-uppercase">
                                            <td> <input class="form-check-input border border-primary" type="checkbox" id="header-checkbox" /> Select</td>
                                            <th>Student Number</th>
                                            <th>Student Name</th>
                                            <th>Exam Type</th>
                                            <th>Mark</th>
                                            <th>Pass/Fail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $student)
                                        <tr>
                                            <td>
                                                <input class="form-check-input border border-primary column-checkbox" type="checkbox" name="user_info_id[]" value="{{$student->user_info_id}}" checked />
                                            </td>
                                            <td>{{ $student->userInfo->student_number }}</td>
                                            <td>{{ $student->userInfo->first_names }} {{ $student->userInfo->surname }}</td>
                                            <td>{{ $student->assessmentType->assessment_type }}</td>
                                            <td>{{ $student->mark }}</td>
                                            <td>{{ $student->pass_fail}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                                {{ __('Save Changes') }}
                            </button>
                            <a href="{{ route('assessments.exam_registration.index') }}" class="btn btn-white btn-active-light-primary me-2">{{ __('Discard') }}</a>
                        </div>
                    </div>
                </div>
            </form>
            @endif
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
</x-base-layout>