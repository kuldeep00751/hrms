<x-base-layout>

    <div class="col-md-12">

        <div class="card mb-5">
            <div class="card-header">
                <div class="pull-left">
                    <strong>Student Details</strong>
                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">
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

        <div class="card">
            <div class="card-header">

                <div class="pull-left">
                    <strong>Register student module</strong>
                </div>
            </div>
            <form method="POST" action="{{ route('registration.modules.register-module') }}" accept-charset="UTF-8" class="form-horizontal">
                {{ csrf_field() }}
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
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <label class="col-lg-3 col-form-label fw-bold fs-6 text-right required">{{ __('Qualification') }}</label>
                            <select class="form-control" id="qualification_id" name="qualification_id" required>
                                <option value="" style="display: none;" disabled selected>Select qualification</option>
                                @foreach ($qualifications as $key => $qualification)
                                <option value="{{ $key }}" {{ old('qualification_id') == $key ? 'selected' : '' }}>
                                    {{ $qualification }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">

                            <label class="col-lg-3 col-form-label fw-bold fs-6 text-right required">{{ __('Module') }}</label>
                            <select class="form-control" id="module_id" name="module_id" data-control="select2" required>
                                <option value="" style="display: none;" disabled selected>Select module</option>
                                @foreach ($modules as $key => $module)
                                <option value="{{ $key }}" {{ old('module_id') == $key ? 'selected' : '' }}>
                                    {{ $module }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="col-lg-3 col-form-label fw-bold fs-6 text-right required">Academic Year <span class="text-danger">*</span></label>
                            <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                                <input class="form-control" name="academic_year" type="text" id="academic_year" value="{{ $academicYear->name }}" readonly>
                                <input class="form-control" name="academic_year_id" type="hidden" id="academic_year_id" value="{{ $academicYear->id }}">
                                <input class="form-control" name="created_by" type="hidden" id="created_by" value="{{ auth()->user()->id }}">
                                <input class="form-control" name="user_info_id" type="hidden" id="user_info_id" value="{{ $userInfo->id }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-lg-3 col-form-label fw-bold fs-6 text-right required">{{ __('Academic Intake') }}</label>
                            <select class="form-control" name="academic_intake_id" required>
                                <option value="" style="display: none;" disabled selected>Select academic intake</option>
                                @foreach ($academicIntakes as $key => $academicIntake)
                                <option value="{{ $key }}" {{ old('academic_intake_id') == $key ? 'selected' : '' }}>
                                    {{ $academicIntake }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="col-lg-3 col-form-label fw-bold fs-6 text-right required">{{ __('Study Mode') }}</label>
                            <select class="form-control" name="study_mode_id" required>
                                <option value="" style="display: none;" disabled selected>Select study mode</option>
                                @foreach ($studyModes as $key => $studyMode)
                                <option value="{{ $key }}" {{ old('study_mode_id') == $key ? 'selected' : '' }}>
                                    {{ $studyMode }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="col-lg-3 col-form-label fw-bold fs-6 text-right required">{{ __('Study Period') }}</label>
                            <select class="form-control" name="study_period_id" required>
                                <option value="" style="display: none;" disabled selected>Select study period</option>
                                @foreach ($studyPeriods as $key => $studyPeriod)
                                <option value="{{ $key }}" {{ old('study_period_id') == $key ? 'selected' : '' }}>
                                    {{ $studyPeriod }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Register Module">

                    </div>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>