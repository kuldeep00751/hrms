
<div class="mb-5 form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Status</label>
    <div class="col-md-12">
        <input class="form-control" name="status" type="text" id="status" value="{{ old('status', optional($registrationStatus)->status) }}" minlength="1" maxlength="50" placeholder="Enter status name here...">
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">Description</label>
    <div class="col-md-12">
        <textarea class="form-control" name="description" id="description" placeholder="Enter status description here...">{{ old('description', optional($registrationStatus)->description) }}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>