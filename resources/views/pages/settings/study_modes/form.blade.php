
<div class="form-group {{ $errors->has('study_mode') ? 'has-error' : '' }}">
    <label for="study_mode" class="col-md-2 control-label">Study Mode</label>
    <div class="col-md-12">
        <input class="form-control" name="study_mode" type="text" id="study_mode" value="{{ old('study_mode', optional($studyMode)->study_mode) }}" minlength="1" placeholder="Enter study mode here...">
        {!! $errors->first('study_mode', '<p class="help-block">:message</p>') !!}
    </div>
</div>

