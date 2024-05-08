
<div class="form-group {{ $errors->has('qualification_id') ? 'has-error' : '' }}">
    <label for="qualification_id" class="col-md-2 control-label">Qualification</label>
    <div class="col-md-10">
        <select class="form-control" id="qualification_id" name="qualification_id">
        	    <option value="" style="display: none;" {{ old('qualification_id', optional($qualificationSubject)->qualification_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select qualification</option>
        	@foreach ($qualifications as $key => $qualification)
			    <option value="{{ $key }}" {{ old('qualification_id', optional($qualificationSubject)->qualification_id) == $key ? 'selected' : '' }}>
			    	{{ $qualification }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('qualification_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('subject_id') ? 'has-error' : '' }}">
    <label for="subject_id" class="col-md-2 control-label">Subject</label>
    <div class="col-md-10">
        <select class="form-control" id="subject_id" name="subject_id">
        	    <option value="" style="display: none;" {{ old('subject_id', optional($qualificationSubject)->subject_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select subject</option>
        	@foreach ($subjects as $key => $subject)
			    <option value="{{ $key }}" {{ old('subject_id', optional($qualificationSubject)->subject_id) == $key ? 'selected' : '' }}>
			    	{{ $subject }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('subject_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

