<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('academic_year_id') ? 'has-error' : '' }}">
            <label for="academic_year_id" class="control-label">Academic Year <span class="text-danger">*</span></label>

            <select class="form-control" id="academic_year_id" name="academic_year_id" required>
                <option value="" style="display: none;" {{ old('academic_year_id', optional($moduleCancellationPolicy)->academic_year_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select academic year</option>
                @foreach ($academicYears as $key => $academicYear)
                <option value="{{ $key }}" {{ old('academic_year_id', optional($moduleCancellationPolicy)->academic_year_id) == $key ? 'selected' : '' }}>
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

            <select class="form-control" id="academic_intake_id" name="academic_intake_id" required>
                <option value="" style="display: none;" {{ old('academic_intake_id', optional($moduleCancellationPolicy)->academic_intake_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select academic intake</option>
                @foreach ($academicIntakes as $key => $academicIntake)
                <option value="{{ $key }}" {{ old('academic_intake_id', optional($moduleCancellationPolicy)->academic_intake_id) == $key ? 'selected' : '' }}>
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
        <div class="form-group {{ $errors->has('study_period_id') ? 'has-error' : '' }}">
            <label for="study_period_id" class="control-label">Study Period <span class="text-danger">*</span></label>

            <select class="form-control" id="study_period_id" name="study_period_id" required>
                <option value="" style="display: none;" {{ old('study_period_id', optional($moduleCancellationPolicy)->study_period_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select study period</option>
                @foreach ($studyPeriods as $key => $studyPeriod)
                <option value="{{ $key }}" {{ old('study_period_id', optional($moduleCancellationPolicy)->study_period_id) == $key ? 'selected' : '' }}>
                    {{ $studyPeriod }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('study_period_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-5 form-group {{ $errors->has('date_from') ? 'has-error' : '' }}">
            <label for="date_from" class="control-label">Date from <span class="text-danger">*</span></label>
            <div class="col-md-12">
                <input class="form-control" name="date_from" type="date" id="date_from" value="{{ old('date_from', optional($moduleCancellationPolicy)->date_from) }}" required>
                {!! $errors->first('date_from', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-5 form-group {{ $errors->has('date_to') ? 'has-error' : '' }}">
            <label for="date_to" class="control-label">Date to <span class="text-danger">*</span></label>
            <div class="col-md-12">
                <input class="form-control" name="date_to" type="date" id="date_to" value="{{ old('date_to', optional($moduleCancellationPolicy)->date_to) }}" required>
                {!! $errors->first('date_to', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>
<div class="mb-5 form-group {{ $errors->has('cancellation_percentage') ? 'has-error' : '' }}">
    <label for="cancellation_percentage" class="control-label">Cancellation Percentage (%)<span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="cancellation_percentage" type="number" id="cancellation_percentage" value="{{ old('cancellation_percentage', optional($moduleCancellationPolicy)->cancellation_percentage) }}" required>
        {!! $errors->first('cancellation_percentage', '<p class="help-block">:message</p>') !!}
    </div>
</div>