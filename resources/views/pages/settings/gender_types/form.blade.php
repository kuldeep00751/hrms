
<div class="form-group {{ $errors->has('gender_type') ? 'has-error' : '' }}">
    <label for="gender_type" class="col-md-2 control-label">Gender Type</label>
    <div class="col-md-10">
        <input class="form-control" name="gender_type" type="text" id="gender_type" value="{{ old('gender_type', optional($genderType)->gender_type) }}" minlength="1" placeholder="Enter gender type here...">
        {!! $errors->first('gender_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

