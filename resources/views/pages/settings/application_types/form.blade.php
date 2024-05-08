
<div class="mb-5 form-group {{ $errors->has('application_type') ? 'has-error' : '' }}">
    <label for="application_type" class="control-label">Application Type <span class="text-danger">*</span></label>
    <div class="col-md-10">
        <input class="form-control" name="application_type" type="text" id="application_type" value="{{ old('application_type', optional($applicationType)->application_type) }}" minlength="1" placeholder="Enter application type here...">
        {!! $errors->first('application_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

