<div class="mb-5 form-group {{ $errors->has('order') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Order</label>
    <div class="col-md-12">
        <input class="form-control" name="order" type="number" id="order" value="{{ old('order', optional($admissionStatus)->order) }}" minlength="1" maxlength="1" placeholder="Enter ordering here...">
        {!! $errors->first('order', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="mb-5 form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Status</label>
    <div class="col-md-12">
        <input class="form-control" name="status" type="text" id="status" value="{{ old('status', optional($admissionStatus)->status) }}" minlength="1" maxlength="50" placeholder="Enter status name here...">
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">Description</label>
    <div class="col-md-12">
        <textarea class="form-control" name="description" id="description" placeholder="Enter status description here...">{{ old('description', optional($admissionStatus)->description) }}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('full_admission') ? 'has-error' : '' }}">
    <label for="full_admission" class="col-md-2 control-label">Full Admission</label>
    <div class="col-md-12">
        <select class="form-control" id="full_admission" name="full_admission">
            <option value="" style="display: none;" {{ old('full_admission', optional($admissionStatus)->full_admission ?: '') == '' ? 'selected' : '' }} disabled selected>Select </option>
            @foreach ($full_admission_options as $key => $value)
            <option value="{{ $key }}" {{ old('full_admission', optional($admissionStatus)->full_admission) == $key ? 'selected' : '' }}>
                {{ $value }}
            </option>
            @endforeach
        </select>
        <p class="help-block text-info">
            Setting this option to <strong>Yes</strong> will permit both back-end and student self-registration. Please make sure this is the admission status the application needs to be in for the students to be registered.
        </p>
        {!! $errors->first('full_admission', '<p class="help-block">:message</p>') !!}
    </div>
</div>