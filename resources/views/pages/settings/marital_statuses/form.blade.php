<div class="form-group {{ $errors->has('marital_status') ? 'has-error' : '' }}">
    <label for="marital_status" class="col-md-2 control-label">Marital Status</label>
    <div class="col-md-12">
        <input class="form-control" name="marital_status" type="text" id="marital_status" value="{{ old('marital_status', optional($maritalStatus)->marital_status) }}" minlength="1" placeholder="Enter marital status here...">
        {!! $errors->first('marital_status', '<p class="help-block">:message</p>') !!}
    </div>
</div>