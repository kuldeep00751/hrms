<div class="mb-5 form-group {{ $errors->has('qualification_name') ? 'has-error' : '' }}">
    <label for="qualification_name" class="control-label">Qualification Name <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="qualification_name" type="text" id="qualification_name" value="{{ old('qualification_name', optional($qualification)->qualification_name) }}" minlength="1" placeholder="Enter qualification name here...">
        {!! $errors->first('qualification_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('qualification_code') ? 'has-error' : '' }}">
    <label for="qualification_code" class="control-label">Qualification Code <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="qualification_code" type="text" id="qualification_code" value="{{ old('qualification_code', optional($qualification)->qualification_code) }}" minlength="1" placeholder="Enter qualification code here...">
        {!! $errors->first('qualification_code', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="row mb-5">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('number_of_years') ? 'has-error' : '' }}">
            <label for="number_of_years" class="control-label">Number of Years <span class="text-danger">*</span></label>

            <select class="form-control" id="number_of_years" name="number_of_years" required>
                <option value="" style="display: none;" {{ old('number_of_years', optional($qualification)->number_of_years ?: '') == '' ? 'selected' : '' }} disabled selected>Select number of years</option>
                @foreach ($numberOfYears as $key => $numberOfYear)
                <option value="{{ $key }}" {{ old('numberOfYear', optional($qualification)->number_of_years) == $key ? 'selected' : '' }}>
                    {{ $numberOfYear }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('number_of_years', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('qualification_credits') ? 'has-error' : '' }}">
            <label for="qualification_credits" class="control-label">Qualification Credits <span class="text-danger">*</span></label>

            <input class="form-control" name="qualification_credits" type="number" id="qualification_credits" value="{{ old('qualification_credits', optional($qualification)->qualification_credits) }}" minlength="1" placeholder="Enter number of years here..." required>
            {!! $errors->first('qualification_credits', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-5 form-group {{ $errors->has('qualification_type_id') ? 'has-error' : '' }}">
            <label for="qualification_type_id" class="control-label">Qualification Level <span class="text-danger">*</span></label>

            <select class="form-control" id="qualification_type_id" name="qualification_type_id" required>
                <option value="" style="display: none;" {{ old('qualification_type_id', optional($qualification)->qualification_type_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select qualification level</option>
                @foreach ($qualificationTypes as $key => $qualificationType)
                <option value="{{ $key }}" {{ old('qualificationType', optional($qualification)->qualification_type_id) == $key ? 'selected' : '' }}>
                    {{ $qualificationType }}
                </option>
                @endforeach
            </select>

            {!! $errors->first('qualification_type_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-5 form-group {{ $errors->has('nqf_level_id') ? 'has-error' : '' }}">
            <label for="nqf_level_id" class="control-label">NQF Level <span class="text-danger">*</span></label>

            <select class="form-control" id="nqf_level_id" name="nqf_level_id" required>
                <option value="" style="display: none;" {{ old('nqf_level_id', optional($qualification)->nqf_level_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select NQF level</option>
                @foreach ($nqfLevels as $key => $nqfLevel)
                <option value="{{ $key }}" {{ old('nqfLevel', optional($qualification)->nqf_level_id) == $key ? 'selected' : '' }}>
                    {{ $nqfLevel }}
                </option>
                @endforeach
            </select>

            {!! $errors->first('nqf_level_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('study_mode_id') ? 'has-error' : '' }}">
    <label for="study_mode_id" class="control-label">Qualification Study Modes <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <select class="form-control" id="study_mode_id" name="study_mode_id[]" multiple="multiple" required>
            <option value="" style="display: none;" {{ old('study_mode_id', optional($qualification)->study_mode_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select study mode</option>
            @foreach ($studyModes as $key => $studyMode)
            @if($qualification)
            <option value="{{ $key }}" {{ old('study_mode_id[]', in_array($key, optional($qualification)->studyModes->pluck('study_mode_id', 'study_mode_id')->all())) ? 'selected' : '' }}>
                @else
            <option value="{{ $key }}" {{ old('study_mode_id[]', optional($qualification)->studyModes) ? 'selected' : '' }}>
                @endif
                {{ $studyMode }}
            </option>
            @endforeach
        </select>

        {!! $errors->first('study_mode_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('campus_id') ? 'has-error' : '' }}">
    <label for="campus_id" class="control-label">Qualification Campus <span class="text-danger">*</span></label>
    <div class="col-md-12">

        <select class="form-control" id="campus_id" name="campus_id[]" multiple="multiple" required>
            <option value="" style="display: none;" {{ old('campus_id', optional($qualification)->campus_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select study mode</option>
            @foreach ($campuses as $key => $campus)
            @if($qualification)
            <option value="{{ $key }}" {{ old('campus_id[]', in_array($key, optional($qualification)->campuses->pluck('campus_id', 'campus_id')->all())) ? 'selected' : '' }}>
                @else
            <option value="{{ $key }}" {{ old('campus_id[]', optional($qualification)->campuses) ? 'selected' : '' }}>
                @endif
                {{ $campus }}
            </option>
            @endforeach
        </select>

        {!! $errors->first('campus_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>