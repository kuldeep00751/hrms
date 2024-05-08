<div class="mb-5 form-group {{ $errors->has('module_code') ? 'has-error' : '' }}">
    <label for="module_code" class="control-label">Module Code <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="module_code" type="text" id="module_code" value="{{ old('module_code', optional($module)->module_code) }}" minlength="1" placeholder="Enter module code here...">
        {!! $errors->first('module_code', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('module_name') ? 'has-error' : '' }}">
    <label for="module_name" class="control-label">Module Name <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="module_name" type="text" id="module_name" value="{{ old('module_name', optional($module)->module_name) }}" minlength="1" placeholder="Enter module name here...">
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('lecture_duration') ? 'has-error' : '' }}">
    <label for="lecture_duration" class="control-label">Lecture Duration <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="lecture_duration" type="text" id="lecture_duration" value="{{ old('lecture_duration', optional($module)->lecture_duration) }}" minlength="1" placeholder="How long is each lecture...">
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('module_credits') ? 'has-error' : '' }}">
            <label for="module_credits" class="control-label">Module Credits <span class="text-danger">*</span></label>

            <input class="form-control" name="module_credits" type="number" id="module_credits" value="{{ old('module_credits', optional($module)->module_credits) }}" minlength="1" placeholder="Enter number of credits here..." required>
            {!! $errors->first('module_credits', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-5 form-group {{ $errors->has('year_level_id') ? 'has-error' : '' }}">
            <label for="year_level_id" class="control-label">Year Level <span class="text-danger">*</span></label>

            <select class="form-control" id="year_level_id" name="year_level_id" required>
                <option value="" style="display: none;" {{ old('year_level_id', optional($module)->year_level_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select Year level</option>
                @foreach ($yearLevels as $key => $yearLevel)
                <option value="{{ $key }}" {{ old('yearLevel', optional($module)->year_level_id) == $key ? 'selected' : '' }}>
                    {{ $yearLevel }}
                </option>
                @endforeach
            </select>

            {!! $errors->first('year_level_id', '<p class="help-block">:message</p>') !!}
            <div class="help-block text-primary alert alert-warning">
                The year level must be less than or equal to the number of years of the qualification.
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-5 form-group {{ $errors->has('module_level_id') ? 'has-error' : '' }}">
            <label for="module_level_id" class="control-label">Module Level <span class="text-danger">*</span></label>

            <select class="form-control" id="module_level_id" name="module_level_id" required>
                <option value="" style="display: none;" {{ old('module_level_id', optional($module)->module_level_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select module level</option>
                @foreach ($moduleLevels as $key => $moduleLevel)
                <option value="{{ $key }}" {{ old('module_level_id', optional($module)->module_level_id) == $key ? 'selected' : '' }}>
                    {{ $moduleLevel }}
                </option>
                @endforeach
            </select>

            {!! $errors->first('module_level_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-5 form-group {{ $errors->has('nqf_level_id') ? 'has-error' : '' }}">
            <label for="nqf_level_id" class="control-label">NQF Level <span class="text-danger">*</span></label>

            <select class="form-control" id="nqf_level_id" name="nqf_level_id" required>
                <option value="" style="display: none;" {{ old('nqf_level_id', optional($module)->nqf_level_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select NQF level</option>
                @foreach ($nqfLevels as $key => $nqfLevel)
                <option value="{{ $key }}" {{ old('nqfLevel', optional($module)->nqf_level_id) == $key ? 'selected' : '' }}>
                    {{ $nqfLevel }}
                </option>
                @endforeach
            </select>

            {!! $errors->first('nqf_level_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="mb-5 form-group {{ $errors->has('study_mode_id') ? 'has-error' : '' }}">
    <label for="study_mode_id" class="control-label">Module Study Modes <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <select class="form-control" id="study_mode_id" name="study_mode_id[]" multiple="multiple" required>
            <option value="" style="display: none;" {{ old('study_mode_id', optional($module)->study_mode_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select study mode</option>
            @foreach ($studyModes as $key => $studyMode)
            @if($module)
            <option value="{{ $key }}" {{ old('study_mode_id[]', in_array($key, optional($module)->studyModes->pluck('id', 'id')->all())) ? 'selected' : '' }}>
                @else
            <option value="{{ $key }}" {{ old('study_mode_id[]', optional($module)->studyModes) ? 'selected' : '' }}>
                @endif
                {{ $studyMode }}
            </option>
            @endforeach
        </select>

        {!! $errors->first('study_mode_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('study_period_id') ? 'has-error' : '' }}">
    <label for="study_period_id" class="control-label">Module Study Periods <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <select class="form-control" id="study_period_id" name="study_period_id[]" multiple="multiple" required>
            <option value="" style="display: none;" {{ old('study_period_id', optional($module)->study_period_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select study mode</option>
            @foreach ($studyPeriods as $key => $studyPeriod)
            @if($module)
            <option value="{{ $key }}" {{ old('study_period_id[]', in_array($key, optional($module)->studyPeriods->pluck('id', 'id')->all())) ? 'selected' : '' }}>
                @else
            <option value="{{ $key }}" {{ old('study_period_id[]', optional($module)->studyPeriods) ? 'selected' : '' }}>
                @endif
                {{ $studyPeriod }}
            </option>
            @endforeach
        </select>

        {!! $errors->first('study_period_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('qualification_id') ? 'has-error' : '' }}">

    <label for="qualification_id" class="control-label">Module Qualifications <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <select class="form-control" id="qualification_id" name="qualification_id[]" multiple="multiple" required>
            <option value="" style="display: none;" {{ old('qualification_id', optional($module)->qualification_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select module qualifications</option>
            @foreach ($qualifications as $key => $qualification)
            @if($module)
            <option value="{{ $key }}" {{ old('qualification_id[]', in_array($key, optional($module)->qualifications->pluck('id', 'id')->all())) ? 'selected' : '' }}>
                @else
            <option value="{{ $key }}" {{ old('qualification_id[]', optional($module)->qualifications) ? 'selected' : '' }}>
                @endif
                {{ $qualification }}
            </option>
            @endforeach
        </select>

        {!! $errors->first('qualification_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>