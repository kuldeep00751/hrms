
<div class="form-group {{ $errors->has('year_level') ? 'has-error' : '' }}">
    <label for="year_level" class="col-md-2 control-label">Year Level</label>
    <div class="col-md-10">
        <input class="form-control" name="year_level" type="number" id="year_level" value="{{ old('year_level', optional($yearLevel)->year_level) }}" minlength="1" placeholder="Enter year level here...">
        {!! $errors->first('year_level', '<p class="help-block">:message</p>') !!}
    </div>
</div>

