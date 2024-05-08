
<div class="form-group {{ $errors->has('matric_type_id') ? 'has-error' : '' }}">
    <label for="matric_type_id" class="col-md-2 control-label">Matric Type</label>
    <div class="col-md-10">
        <select class="form-control" id="matric_type_id" name="matric_type_id">
        	    <option value="" style="display: none;" {{ old('matric_type_id', optional($gradingScale)->matric_type_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select matric type</option>
        	@foreach ($matricTypes as $key => $matricType)
			    <option value="{{ $key }}" {{ old('matric_type_id', optional($gradingScale)->matric_type_id) == $key ? 'selected' : '' }}>
			    	{{ $matricType }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('matric_type_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('subject_id') ? 'has-error' : '' }}">
    <label for="subject_id" class="col-md-2 control-label">Subject</label>
    <div class="col-md-10">
        <select class="form-control" id="subject_id" name="subject_id">
        	    <option value="" style="display: none;" {{ old('subject_id', optional($gradingScale)->subject_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select subject</option>
        	@foreach ($subjects as $key => $subject)
			    <option value="{{ $key }}" {{ old('subject_id', optional($gradingScale)->subject_id) == $key ? 'selected' : '' }}>
			    	{{ $subject }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('subject_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('symbol') ? 'has-error' : '' }}">
    <label for="symbol" class="col-md-2 control-label">Symbol</label>
    <div class="col-md-10">
        <input class="form-control" name="symbol" type="text" id="symbol" value="{{ old('symbol', optional($gradingScale)->symbol) }}" minlength="1" placeholder="Enter symbol here...">
        {!! $errors->first('symbol', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('points') ? 'has-error' : '' }}">
    <label for="points" class="col-md-2 control-label">Points</label>
    <div class="col-md-10">
        <input class="form-control" name="points" type="text" id="points" value="{{ old('points', optional($gradingScale)->points) }}" minlength="1" placeholder="Enter points here...">
        {!! $errors->first('points', '<p class="help-block">:message</p>') !!}
    </div>
</div>

