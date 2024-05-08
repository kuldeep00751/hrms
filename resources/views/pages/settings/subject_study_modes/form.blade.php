
<div class="form-group {{ $errors->has('subject_id') ? 'has-error' : '' }}">
    <label for="subject_id" class="col-md-2 control-label">Subject</label>
    <div class="col-md-10">
        <select class="form-control" id="subject_id" name="subject_id">
        	    <option value="" style="display: none;" {{ old('subject_id', optional($subjectStudyMode)->subject_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select subject</option>
        	@foreach ($subjects as $key => $subject)
			    <option value="{{ $key }}" {{ old('subject_id', optional($subjectStudyMode)->subject_id) == $key ? 'selected' : '' }}>
			    	{{ $subject }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('subject_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('study_mode_id') ? 'has-error' : '' }}">
    <label for="study_mode_id" class="col-md-2 control-label">Study Mode</label>
    <div class="col-md-10">
        <select class="form-control" id="study_mode_id" name="study_mode_id">
        	    <option value="" style="display: none;" {{ old('study_mode_id', optional($subjectStudyMode)->study_mode_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select study mode</option>
        	@foreach ($studyModes as $key => $studyMode)
			    <option value="{{ $key }}" {{ old('study_mode_id', optional($subjectStudyMode)->study_mode_id) == $key ? 'selected' : '' }}>
			    	{{ $studyMode }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('study_mode_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

