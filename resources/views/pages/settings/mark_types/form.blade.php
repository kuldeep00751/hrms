
<div class="mb-5 form-group {{ $errors->has('mark_type') ? 'has-error' : '' }}">
    <label for="mark_type" class="col-md-2 control-label">Mark Type</label>
    <div class="col-md-12">
        <input class="form-control" name="mark_type" type="text" id="mark_type" value="{{ old('mark_type', optional($markType)->mark_type) }}" minlength="1" maxlength="50" placeholder="Enter assessment mark type here...">
        {!! $errors->first('mark_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>
