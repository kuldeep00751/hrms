<div class="mb-5 form-group {{ $errors->has('document_name') ? 'has-error' : '' }}">
    <label for="document_name" class="col-md-6 control-label">Document Name</label>
    <div class="col-md-12">
        <input class="form-control" name="document_name" type="text" id="document_name" value="{{ old('document_name', optional($requiredDocument)->document_name) }}" minlength="1" placeholder="Enter document name here...">
        {!! $errors->first('document_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_required') ? 'has-error' : '' }}">
    <label for="is_required" class="col-md-6 control-label">Is Required</label>
    <div class="form-check form-check-custom form-check-solid">
        <input id="is_required_1" class="" name="is_required" type="checkbox" value="1" {{ old('is_required', optional($requiredDocument)->is_required) == '1' ? 'checked' : '' }}>
        <label class="form-check-label" for="is_required_1">
            Yes
        </label>
    </div>

    {!! $errors->first('is_required', '<p class="help-block">:message</p>') !!}
</div>
