<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('module_id') ? 'has-error' : '' }}">
            <label for="module_id" class="control-label">Module <span class="text-danger">*</span></label>

            <select class="form-control" id="module_id" name="module_id" data-control="select2" required>
                <option value="" style="display: none;" {{ old('module_id', optional($moduleAllocation)->module_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select module</option>
                @foreach ($modules as $key => $module)
                <option value="{{ $key }}" {{ old('module_id', optional($moduleAllocation)->module_id) == $key ? 'selected' : '' }}>
                    {{ $module }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('module_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('academic_year_id') ? 'has-error' : '' }}">
            <label for="academic_year_id" class="control-label">Academic Year <span class="text-danger">*</span></label>

            <select class="form-control" id="academic_year_id" name="academic_year_id" required>
                <option value="" style="display: none;" {{ old('academic_year_id', optional($moduleAllocation)->academic_year_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select academic year</option>
                @foreach ($academicYears as $key => $academicYear)
                <option value="{{ $key }}" {{ old('academic_year_id', optional($moduleAllocation)->academic_year_id) == $key ? 'selected' : '' }}>
                    {{ $academicYear }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('academic_year_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('academic_intake_id') ? 'has-error' : '' }}">
            <label for="academic_intake_id" class="control-label">Academic Intake <span class="text-danger">*</span></label>

            <select class="form-control" id="academic_intake_id" name="academic_intake_id[]" multiple="multiple"  required>
                <option value="" style="display: none;" {{ old('academic_intake_id', optional($moduleAllocation)->academic_intake_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select intake</option>
                @foreach ($academicIntakes as $key => $academicIntake)
                <option value="{{ $key }}" {{ old('academic_intake_id', optional($moduleAllocation)->academic_intake_id) == $key ? 'selected' : '' }}>
                    {{ $academicIntake }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('study_mode_id') ? 'has-error' : '' }}">
            <label for="study_mode_id" class="control-label">Study Mode <span class="text-danger">*</span></label>

            <select class="form-control" id="study_mode_id" name="study_mode_id" required>
                <option value="" style="display: none;" {{ old('study_mode_id', optional($moduleAllocation)->study_mode_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select study mode</option>
                @foreach ($studyModes as $key => $studyMode)
                <option value="{{ $key }}" {{ old('study_mode_id', optional($moduleAllocation)->study_mode_id) == $key ? 'selected' : '' }}>
                    {{ $studyMode }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('campus_id') ? 'has-error' : '' }}">
            <label for="campus_id" class="control-label">Campus <span class="text-danger">*</span></label>

            <select class="form-control" id="campus_id" name="campus_id" required>
                <option value="" style="display: none;" {{ old('campus_id', optional($moduleAllocation)->campus_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select campus</option>
                @foreach ($campuses as $key => $campus)
                <option value="{{ $key }}" {{ old('campus_id', optional($moduleAllocation)->campus_id) == $key ? 'selected' : '' }}>
                    {{ $campus }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('campus_id') ? 'has-error' : '' }}">
            <label for="user_id" class="control-label">Teaching Staff <span class="text-danger">*</span></label>

            <select class="form-control" id="user_id" name="user_id" required data-control="select2">
                <option value="" style="display: none;" {{ old('user_id', optional($moduleAllocation)->user_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select teaching staff</option>
                @foreach ($users as $key => $user)
                <option value="{{ $key }}" {{ old('user_id', optional($moduleAllocation)->user_id) == $key ? 'selected' : '' }}>
                    {{ $user }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>