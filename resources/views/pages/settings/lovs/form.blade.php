<div class="mb-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="label" class="control-label">Label <span class="text-danger">*</span></label>
    <div class="col-md-10">
        <input class="form-control" name="label" type="text" id="label" value="{{ old('label', optional($lov)->label) }}" readonly>
        {!! $errors->first('label', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('value') ? 'has-error' : '' }}">
    <label for="value" class="control-label">Value <span class="text-danger">*</span></label>
    <div class="col-md-10">
        <input class="form-control" name="value" type="number" id="value" value="{{ old('value', optional($lov)->value) }}">
        {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
    </div>
</div>