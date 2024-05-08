
<div class="form-group {{ $errors->has('student_type') ? 'has-error' : '' }}">
    <label for="student_type" class="col-md-2 control-label">Student Type</label>
    <div class="col-md-10">
        <input class="form-control" name="student_type" type="text" id="student_type" value="{{ old('student_type', optional($studentType)->student_type) }}" minlength="1" placeholder="Enter student type here...">
        {!! $errors->first('student_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

