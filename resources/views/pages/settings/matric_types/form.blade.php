<div class="mb-5 form-group {{ $errors->has('matric_type') ? 'has-error' : '' }}">
    <label for="matric_type" class="control-label">Matric Type <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="matric_type" type="text" id="matric_type" value="{{ old('matric_type', optional($matricType)->matric_type) }}" minlength="1" placeholder="Enter matric type here...">
        {!! $errors->first('matric_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('education_system_id') ? 'has-error' : '' }}">
    <label for="education_system_id" class="control-label">Education System <span class="text-danger">*</span></label>

    <select class="form-control" id="education_system_id" name="education_system_id" required>
        <option value="" style="display: none;" {{ old('education_system_id', optional($matricType)->education_system_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select education system</option>
        @foreach ($educationSystems as $key => $systemEducation)
        <option value="{{ $key }}" {{ old('education_system_id', optional($matricType)->education_system_id) == $key ? 'selected' : '' }}>
            {{ $systemEducation }}
        </option>
        @endforeach
    </select>

    {!! $errors->first('education_system_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="mb-5 form-group {{ $errors->has('grade') ? 'has-error' : '' }}">
    <label for="grade" class="control-label">Grade <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="grade" type="text" id="grade" value="{{ old('grade', optional($matricType)->grade) }}" minlength="1" placeholder="Enter grade here...">
        {!! $errors->first('grade', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('points') ? 'has-error' : '' }}">
    <label for="points" class="control-label">Points <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="points" type="text" id="points" value="{{ old('points', optional($matricType)->points) }}" minlength="1" placeholder="Enter points here...">
        {!! $errors->first('points', '<p class="help-block">:message</p>') !!}
    </div>
</div>