<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('module_id') ? 'has-error' : '' }}">
            <label for="module_id" class="control-label">Module <span class="text-danger">*</span></label>

            <select class="form-control" id="module_id" name="module_id" data-control="select2" required>
                <option value="" style="display: none;" {{ old('module_id', optional($subjectFee)->module_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select module</option>
                @foreach ($modules as $key => $module)
                <option value="{{ $key }}" {{ old('module_id', optional($subjectFee)->module_id) == $key ? 'selected' : '' }}>
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
                <option value="" style="display: none;" {{ old('academic_year_id', optional($subjectFee)->academic_year_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select academic year</option>
                @foreach ($academicYears as $key => $academicYear)
                <option value="{{ $key }}" {{ old('academic_year_id', optional($subjectFee)->academic_year_id) == $key ? 'selected' : '' }}>
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
        <div class="form-group {{ $errors->has('student_type_id') ? 'has-error' : '' }}">
            <label for="student_type_id" class="control-label">Student type <span class="text-danger">*</span></label>

            <select class="form-control" id="student_type_id" name="student_type_id" required>
                <option value="" style="display: none;" {{ old('student_type_id', optional($subjectFee)->student_type_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select student type</option>
                @foreach ($studentTypes as $key => $studentType)
                <option value="{{ $key }}" {{ old('student_type_id', optional($subjectFee)->student_type_id) == $key ? 'selected' : '' }}>
                    {{ $studentType }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('student_type_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('assessment_type_id') ? 'has-error' : '' }}">
            <label for="assessment_type_id" class="control-label">Assessment Type <span class="text-danger">*</span></label>

            <select class="form-control" id="assessment_type_id" name="assessment_type_id" required>
                <option value="" style="display: none;" {{ old('assessment_type_id', optional($subjectFee)->assessment_type_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select assessment type</option>
                @foreach ($assessmentTypes as $key => $assessmentType)
                <option value="{{ $key }}" {{ old('assessment_type_id', optional($subjectFee)->assessment_type_id) == $key ? 'selected' : '' }}>
                    {{ $assessmentType }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('assessment_type_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('academic_process') ? 'has-error' : '' }}">
            <label for="academic_process" class="control-label">Academic Process <span class="text-danger">*</span></label>
            <input class="form-control" name="academic_process" type="text" id="academic_process" value="Registration" readonly>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
            <label for="amount" class="control-label">Subject Fee (N$) <span class="text-danger">*</span></label>
            <input class="form-control" name="amount" type="text" id="amount" value="{{ old('amount', optional($subjectFee)->amount) }}">
            <input class="form-control" name="created_by" type="hidden" id="created_by" value="{{ auth()->user()->id }}">
        </div>
    </div>
</div>