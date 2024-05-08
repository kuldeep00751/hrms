<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('academic_year_id') ? 'has-error' : '' }}">
            <label for="academic_year_id" class="control-label required">Academic Year </label>

            <select class="form-control" id="academic_year_id" name="academic_year_id" data-control="select2" required>
                <option value="" style="display: none;" {{ old('academic_year_id', optional($assessmentSuppression)->academic_year_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select Academic Year</option>
                @foreach ($academicYears as $key => $academicYear)
                <option value="{{ $key }}" {{ old('academic_year_id', optional($assessmentSuppression)->academic_year_id) == $key ? 'selected' : '' }}>
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
            <label for="academic_intake_id" class="control-label required">Academic Intake</label>

            <select class="form-control" id="academic_intake_id" name="academic_intake_id" required>
                <option value="" style="display: none;" {{ old('academic_intake_id', optional($assessmentSuppression)->academic_intake_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select academic intake</option>
                @foreach ($academicIntakes as $key => $academicIntake)
                <option value="{{ $key }}" {{ old('academic_intake_id', optional($assessmentSuppression)->academic_intake_id) == $key ? 'selected' : '' }}>
                    {{ $academicIntake }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('academic_intake_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('campus_id') ? 'has-error' : '' }}">
            <label for="campus_id" class="control-label required">Campus</label>

            <select class="form-control" id="campus_id" name="campus_id" required>
                <option value="" style="display: none;" {{ old('campus_id', optional($assessmentSuppression)->campus_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select campus</option>
                @foreach ($campuses as $key => $campus)
                <option value="{{ $key }}" {{ old('campus_id', optional($assessmentSuppression)->campus_id) == $key ? 'selected' : '' }}>
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
            <label for="study_mode_id" class="control-label required">Study Mode</label>

            <select class="form-control" id="study_mode_id" name="study_mode_id" required>
                <option value="" style="display: none;" {{ old('study_mode_id', optional($assessmentSuppression)->study_mode_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select study mode</option>
                @foreach ($studyModes as $key => $studyMode)
                <option value="{{ $key }}" {{ old('study_mode_id', optional($assessmentSuppression)->study_mode_id) == $key ? 'selected' : '' }}>
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
        <div class="form-group {{ $errors->has('suppression_type') ? 'has-error' : '' }}">
            <label for="suppression_type" class="control-label required">Suppression Mark Type</label>

            <select class="form-control" id="suppression_type" name="suppression_type" required>
                <option value="" style="display: none;" {{ old('suppression_type', optional($assessmentSuppression)->suppression_type ?: '') == '' ? 'selected' : '' }} disabled selected>Select suppression type</option>
                @foreach ($suppressionTypes as $key => $suppressionType)
                <option value="{{ $key }}" {{ old('suppression_type', optional($assessmentSuppression)->suppression_type) == $key ? 'selected' : '' }}>
                    {{ $suppressionType }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('suppression_type', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<input type="hidden" name="created_by" value="{{ auth()->user()->id }}">