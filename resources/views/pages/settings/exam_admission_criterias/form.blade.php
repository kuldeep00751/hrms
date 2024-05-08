<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('module_id') ? 'has-error' : '' }}">
            <label for="module_id" class="control-label">Module <span class="text-danger">*</span></label>

            <select class="form-control" id="module_id" name="module_id" data-control="select2" required>
                <option value="" style="display: none;" {{ old('module_id', optional($examAdmissionCriteria)->module_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select module</option>
                @foreach ($modules as $key => $module)
                <option value="{{ $key }}" {{ old('module_id', optional($examAdmissionCriteria)->module_id) == $key ? 'selected' : '' }}>
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

            <select class="form-control" id="academic_year_id" name="academic_year_id" data-control="select2" required>
                <option value="" style="display: none;" {{ old('academic_year_id', optional($examAdmissionCriteria)->academic_year_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select Academic Year</option>
                @foreach ($academicYears as $key => $academicYear)
                <option value="{{ $key }}" {{ old('academic_year_id', optional($examAdmissionCriteria)->academic_year_id) == $key ? 'selected' : '' }}>
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
        <div class="form-group {{ $errors->has('assessment_type_id') ? 'has-error' : '' }}">
            <label for="assessment_type_id" class="control-label">Assessment Type <span class="text-danger">*</span></label>

            <select class="form-control" id="assessment_type_id" name="assessment_type_id" required>
                <option value="" style="display: none;" {{ old('assessment_type_id', optional($examAdmissionCriteria)->assessment_type_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select Assessment Year</option>
                @foreach ($assessmentTypes as $key => $assessmentType)
                <option value="{{ $key }}" {{ old('assessment_type_id', optional($examAdmissionCriteria)->assessment_type_id) == $key ? 'selected' : '' }}>
                    {{ $assessmentType }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('assessment_type_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('minimum_attendance') ? 'has-error' : '' }}">
    <label for="minimum_attendance" class="control-label">Minimum Attendance (Hours)</label>
    <div class="col-md-12">
        <input class="form-control" name="minimum_attendance" type="number" id="minimum_attendance" value="{{ old('minimum_attendance', optional($examAdmissionCriteria)->minimum_attendance) }}" minlength="1" placeholder="Enter module minimum attendance here...">
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="minimum_ca_mark" class="control-label">Minimum CA for Exam Admission (%)<span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="minimum_ca_mark" type="number" value="{{ old('minimum_ca_mark', optional($examAdmissionCriteria)->minimum_ca_mark) }}" required>
        {!! $errors->first('minimum_ca_mark', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('ca_weight') ? 'has-error' : '' }}">
    <label for="ca_weight" class="control-label">CA Weight towards Final Mark (%)<span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="ca_weight" type="number" value="{{ old('ca_weight', optional($examAdmissionCriteria)->ca_weight) }}" required>
        {!! $errors->first('ca_weight', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('exam_weight') ? 'has-error' : '' }}">
    <label for="exam_weight" class="control-label">Exam Weight towards Final Mark (%)<span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="exam_weight" type="number" value="{{ old('exam_weight', optional($examAdmissionCriteria)->exam_weight) }}" required>
        {!! $errors->first('exam_weight', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('assessment_result_code_id') ? 'has-error' : '' }}">
            <label for="assessment_result_code_id" class="control-label">Subminimum Result Code <span class="text-danger">*</span></label>

            <select class="form-control" id="assessment_result_code_id" name="assessment_result_code_id" required>
                <option value="" style="display: none;" {{ old('assessment_result_code_id', optional($examAdmissionCriteria)->assessment_result_code_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select Subminimum Result Code</option>
                @foreach ($assessmentResultCodes as $key => $assessmentResultCode)
                <option value="{{ $key }}" {{ old('assessment_result_code_id', optional($examAdmissionCriteria)->assessment_result_code_id) == $key ? 'selected' : '' }}>
                    {{ $assessmentResultCode }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('assessment_result_code_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<hr>

<div class="mb-5 form-group {{ $errors->has('absent_exam_indicator') ? 'has-error' : '' }}">
    <label for="absent_exam_indicator" class="control-label">Absent from exam indicator</label>
    <p class="help-text text-info">
        This field can be left blank.
    </p>
    <div class="col-md-12 mb-3">
        <input class="form-control" name="absent_exam_indicator" type="number" value="{{ old('absent_exam_indicator', optional($examAdmissionCriteria)->absent_exam_indicator) }}">
        {!! $errors->first('absent_exam_indicator', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('absent_exam_result_code') ? 'has-error' : '' }}">
            <label for="absent_exam_result_code" class="control-label">Absent from exam result code <span class="text-danger">*</span></label>

            <select class="form-control" id="absent_exam_result_code" name="absent_exam_result_code" required>
                <option value="" style="display: none;" {{ old('absent_exam_result_code', optional($examAdmissionCriteria)->absent_exam_result_code ?: '') == '' ? 'selected' : '' }} disabled selected>Select Result Code</option>
                @foreach ($assessmentResultCodes as $key => $assessmentResultCode)
                <option value="{{ $key }}" {{ old('absent_exam_result_code', optional($examAdmissionCriteria)->absent_exam_result_code) == $key ? 'selected' : '' }}>
                    {{ $assessmentResultCode }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('absent_exam_result_code', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<input class="form-control" name="updated_by" type="hidden" value="{{ auth()->user()->id }}">
<input class="form-control" name="created_by" type="hidden" value="{{ auth()->user()->id }}">
<script>
    document.addEventListener("wheel", function(event) {
        if (document.activeElement.type === "number") {
            document.activeElement.blur();
        }
    });
</script>