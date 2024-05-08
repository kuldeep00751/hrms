
<div class="form-group {{ $errors->has('subject_id') ? 'has-error' : '' }}">
    <label for="subject_id" class="col-md-2 control-label">Subject</label>
    <div class="col-md-10">
        <select class="form-control" id="subject_id" name="subject_id">
        	    <option value="" style="display: none;" {{ old('subject_id', optional($subjectStudyPeriod)->subject_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select subject</option>
        	@foreach ($subjects as $key => $subject)
			    <option value="{{ $key }}" {{ old('subject_id', optional($subjectStudyPeriod)->subject_id) == $key ? 'selected' : '' }}>
			    	{{ $subject }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('subject_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('study_period_id') ? 'has-error' : '' }}">
    <label for="study_period_id" class="col-md-2 control-label">Study Period</label>
    <div class="col-md-10">
        <select class="form-control" id="study_period_id" name="study_period_id">
        	    <option value="" style="display: none;" {{ old('study_period_id', optional($subjectStudyPeriod)->study_period_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select study period</option>
        	@foreach ($studyPeriods as $key => $studyPeriod)
			    <option value="{{ $key }}" {{ old('study_period_id', optional($subjectStudyPeriod)->study_period_id) == $key ? 'selected' : '' }}>
			    	{{ $studyPeriod }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('study_period_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

