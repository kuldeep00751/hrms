<div class="mb-5 form-group {{ $errors->has('assessment_type') ? 'has-error' : '' }}">
    <label for="assessment_type" class="control-label">Assessment Name <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="assessment_type" type="text" id="assessment_type" value="{{ old('assessment_type', optional($assessmentType)->assessment_type) }}" minlength="1" maxlength="255" placeholder="Enter assessment type here...">
        {!! $errors->first('assessment_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('assessment_type_code') ? 'has-error' : '' }}">
    <label for="assessment_type_code" class="control-label">Code <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="assessment_type_code" type="text" id="assessment_type_code" value="{{ old('assessment_type_code', optional($assessmentType)->assessment_type_code) }}" minlength="1" maxlength="255" placeholder="Enter assessment type here...">
        {!! $errors->first('assessment_type_code', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('maximum_mark') ? 'has-error' : '' }}">
    <label for="maximum_mark" class="control-label required">Maximum Mark</label>
    <div class="col-md-12">
        <input class="form-control" name="maximum_mark" type="number" id="maximum_mark" value="{{ old('maximum_mark', optional($assessmentType)->maximum_mark) }}" minlength="1" placeholder="Enter assessment maximum mark here...">
    </div>
</div>

<div class="form-group {{ $errors->has('default') ? 'has-error' : '' }}">
    <label for="default" class="col-md-12 control-label">Default Exam (Yes/No)</label>
    <div class="col-md-12">
        <select class="form-control" id="default" name="default">
            <option value="" style="display: none;" {{ old('default', optional($assessmentType)->default ?: '') == '' ? 'selected' : '' }} disabled selected>Select </option>
            @foreach ($requiredOptions as $key => $value)
            <option value="{{ $key }}" {{ old('default', optional($assessmentType)->default) == $key ? 'selected' : '' }}>
                {{ $value }}
            </option>
            @endforeach
        </select>
        <p class="help-block text-info">
            Setting this option to <strong>Yes</strong> will force students to be registered for this assessment type during registration
        </p>
        {!! $errors->first('required', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<script>
    document.addEventListener("wheel", function(event) {
        if (document.activeElement.type === "number") {
            document.activeElement.blur();
        }
    });
</script>