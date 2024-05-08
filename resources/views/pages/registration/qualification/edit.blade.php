<x-base-layout>
    <div class="col-md-6 mx-auto">

        <div class="card">
            <div class="card-header">

                <div class="pull-left">
                    <strong>Update Student Registration</strong>
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
                    {!! $error !!}
                    @endforeach
                </ul>
                @endif
                <form method="POST" action="{{ route('registration.qualification.update', $registration) }}" accept-charset="UTF-8" class="form-horizontal">
                    <div class="card-body">

                        @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif
                        
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="student_name" class="control-label">Student Name </label>
                                    <input class="form-control" name="student_name" type="text" id="student_name" value="{{$registration->userInfo->first_names}} {{$registration->userInfo->surname}}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="student_name" class="control-label">Student Number </label>
                                    <input class="form-control" name="student_number" type="text" id="student_number" value="{{$registration->userInfo->student_number}}" readonly>
                                </div>
                            </div>
                        </div>


                        <div class="row mb-5">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="qualification" class="control-label">Qualification </label>
                                    <input class="form-control" name="qualification" type="text" id="qualification" value="{{ $registration->qualification->qualification_name }}" readonly>
                                </div>
                            </div>
                        </div>


                        <div class="row mb-5">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('campus_id') ? 'has-error' : '' }}">
                                    <label for="campus_id" class="control-label">Campus<span class="text-danger">*</span></label>

                                    <select class="form-control" id="campus_id" name="campus_id" required>
                                        <option value="" style="display: none;" {{ old('campus_id', optional($registration)->campus_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select campus</option>
                                        @foreach ($campuses as $key => $campus)
                                        <option value="{{ $key }}" {{ old('campus_id', optional($registration)->campus_id) == $key ? 'selected' : '' }}>
                                            {{ $campus }}
                                        </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('campus_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('study_mode_id') ? 'has-error' : '' }}">
                                    <label for="study_mode_id" class="control-label">Study Mode <span class="text-danger">*</span></label>

                                    <select class="form-control" id="study_mode_id" name="study_mode_id" required>
                                        <option value="" style="display: none;" {{ old('study_mode_id', optional($registration)->study_mode_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select study mode</option>
                                        @foreach ($studyModes as $key => $studyMode)
                                        <option value="{{ $key }}" {{ old('study_mode_id', optional($registration)->study_mode_id) == $key ? 'selected' : '' }}>
                                            {{ $studyMode }}
                                        </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('study_mode_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('academic_intake_id') ? 'has-error' : '' }}">
                                    <label for="academic_intake_id" class="control-label">Academic Intake <span class="text-danger">*</span></label>

                                    <select class="form-control" id="academic_intake_id" name="academic_intake_id" required>
                                        <option value="" style="display: none;" {{ old('academic_intake_id', optional($registration)->academic_intake_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select study mode</option>
                                        @foreach ($academicIntakes as $key => $academicIntake)
                                        <option value="{{ $key }}" {{ old('academic_intake_id', optional($registration)->academic_intake_id) == $key ? 'selected' : '' }}>
                                            {{ $academicIntake }}
                                        </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('academic_intake_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <input class="btn btn-success" type="submit" value="Update">
                            <a href="{{ route('marital_statuses.marital_status.index') }}">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-base-layout>