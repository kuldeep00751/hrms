
<div class="form-group {{ $errors->has('system_name') ? 'has-error' : '' }}">
    <label for="system_name" class="control-label">System Name <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="system_name" type="text" id="system_name" value="{{ old('system_name', optional($educationSystem)->system_name) }}" minlength="1" placeholder="Enter system name here..." required>
        {!! $errors->first('system_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

