
<div class="form-group {{ $errors->has('campus_id') ? 'has-error' : '' }}">
    <label for="campus_id" class="col-md-2 control-label">Campus</label>
    <div class="col-md-10">
        <select class="form-control" id="campus_id" name="campus_id">
        	    <option value="" style="display: none;" {{ old('campus_id', optional($qualificationCampus)->campus_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select campus</option>
        	@foreach ($campuses as $key => $campus)
			    <option value="{{ $key }}" {{ old('campus_id', optional($qualificationCampus)->campus_id) == $key ? 'selected' : '' }}>
			    	{{ $campus }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('campus_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('qualification_id') ? 'has-error' : '' }}">
    <label for="qualification_id" class="col-md-2 control-label">Qualification</label>
    <div class="col-md-10">
        <select class="form-control" id="qualification_id" name="qualification_id">
        	    <option value="" style="display: none;" {{ old('qualification_id', optional($qualificationCampus)->qualification_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select qualification</option>
        	@foreach ($qualifications as $key => $qualification)
			    <option value="{{ $key }}" {{ old('qualification_id', optional($qualificationCampus)->qualification_id) == $key ? 'selected' : '' }}>
			    	{{ $qualification }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('qualification_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

