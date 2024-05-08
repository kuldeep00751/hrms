<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('academic_year_id') ? 'has-error' : '' }}">
            <label for="academic_year_id" class="control-label">Academic Year <span class="text-danger">*</span></label>

            <select class="form-control" id="academic_year_id" name="academic_year_id" data-control="select2" required>
                <option value="" style="display: none;" {{ old('academic_year_id', optional($examRegistrationCriteria)->academic_year_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select Academic Year</option>
                @foreach ($academicYears as $key => $academicYear)
                <option value="{{ $key }}" {{ old('academic_year_id', optional($examRegistrationCriteria)->academic_year_id) == $key ? 'selected' : '' }}>
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
            <label for="assessment_type_id" class="control-label">Exam To Be Registered <span class="text-danger">*</span></label>

            <select class="form-control" id="assessment_type_id" name="assessment_type_id" required>
                <option value="" style="display: none;" {{ old('assessment_type_id', optional($examRegistrationCriteria)->assessment_type_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select Assessment Type</option>
                @foreach ($toBeRegisteredAssessmentType as $key => $assessmentType)
                <option value="{{ $key }}" {{ old('assessment_type_id', optional($examRegistrationCriteria)->assessment_type_id) == $key ? 'selected' : '' }}>
                    {{ $assessmentType }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('required_assessment_mark') ? 'has-error' : '' }}">
            <label for="required_assessment_mark" class="control-label">Required Assessment Mark Type<span class="text-danger">*</span></label>

            <select class="form-control" id="required_assessment_mark" name="required_assessment_mark" required>
                <option value="" style="display: none;" {{ old('required_assessment_mark', optional($examRegistrationCriteria)->required_assessment_mark ?: '') == '' ? 'selected' : '' }} disabled selected>Select Assessment Mark Type</option>
                @foreach ($assessmentMarkTypes as $key => $assessmentMarkType)
                <option value="{{ $key }}" {{ old('required_assessment_mark', optional($examRegistrationCriteria)->required_assessment_mark) == $key ? 'selected' : '' }}>
                    {{ $assessmentMarkType }}
                </option>
                @endforeach
            </select>
        </div>

    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('required_assessment_exam_id') ? 'has-error' : '' }}">
            <label for="required_assessment_exam_id" class="control-label">Required Exam Type <span class="text-danger">*</span></label>

            <select class="form-control" id="required_assessment_exam_id" name="required_assessment_exam_id" required>
                <option value="" style="display: none;" {{ old('required_assessment_exam_id', optional($examRegistrationCriteria)->required_assessment_exam_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select Required Assessment Type</option>
                @foreach ($requiredAssessmentTypes as $key => $assessmentType)
                <option value="{{ $key }}" {{ old('required_assessment_exam_id', optional($examRegistrationCriteria)->required_assessment_exam_id) == $key ? 'selected' : '' }}>
                    {{ $assessmentType }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="help-text alert-info">
            This is the exam which a student must have written for them to qualify to be registered for the selected exam.
        </div>
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('minimum_mark') ? 'has-error' : '' }}">
    <label for="minimum_mark" class="control-label required">Minimum Mark</label>
    <div class="col-md-12">
        <input class="form-control" name="minimum_mark" type="number" id="minimum_mark" value="{{ old('minimum_mark', optional($examRegistrationCriteria)->minimum_mark) }}" minlength="1" placeholder="Enter module minimum mark here...">
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('maximum_mark') ? 'has-error' : '' }}">
    <label for="maximum_mark" class="control-label required">Maximum Mark</label>
    <div class="col-md-12">
        <input class="form-control" name="maximum_mark" type="number" id="maximum_mark" value="{{ old('maximum_mark', optional($examRegistrationCriteria)->maximum_mark) }}" minlength="1" placeholder="Enter module maximum mark here...">
    </div>
</div>

<script>
    document.addEventListener("wheel", function(event) {
        if (document.activeElement.type === "number") {
            document.activeElement.blur();
        }
    });
</script>