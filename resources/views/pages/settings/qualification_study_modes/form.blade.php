
<div class="form-group {{ $errors->has('qualification_id') ? 'has-error' : '' }}">
    <label for="qualification_id" class="col-md-2 control-label">Qualification</label>
    <div class="col-md-10">
        <select class="form-control" id="qualification_id" name="qualification_id">
        	    <option value="" style="display: none;" {{ old('qualification_id', optional($qualificationStudyMode)->qualification_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select qualification</option>
        	@foreach ($qualifications as $key => $qualification)
			    <option value="{{ $key }}" {{ old('qualification_id', optional($qualificationStudyMode)->qualification_id) == $key ? 'selected' : '' }}>
			    	{{ $qualification }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('qualification_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('study_mode_id') ? 'has-error' : '' }}">
    <label for="study_mode_id" class="col-md-2 control-label">Study Mode</label>
    <div class="col-md-10">
        <select class="form-control" id="study_mode_id" name="study_mode_id">
        	    <option value="" style="display: none;" {{ old('study_mode_id', optional($qualificationStudyMode)->study_mode_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select study mode</option>
        	@foreach ($studyModes as $key => $studyMode)
			    <option value="{{ $key }}" {{ old('study_mode_id', optional($qualificationStudyMode)->study_mode_id) == $key ? 'selected' : '' }}>
			    	{{ $studyMode }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('study_mode_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

