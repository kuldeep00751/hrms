
<div class="form-group {{ $errors->has('study_period') ? 'has-error' : '' }}">
    <label for="study_period" class="col-md-2 control-label">Study Period</label>
    <div class="col-md-12">
        <input class="form-control" name="study_period" type="text" id="study_period" value="{{ old('study_period', optional($studyPeriod)->study_period) }}" minlength="1" placeholder="Enter study period here...">
        {!! $errors->first('study_period', '<p class="help-block">:message</p>') !!}
    </div>
</div>

