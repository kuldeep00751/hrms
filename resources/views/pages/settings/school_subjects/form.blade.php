<div class="form-group {{ $errors->has('subject_name') ? 'has-error' : '' }}">
    <label for="subject_name" class="control-label">Subject Name <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="subject_name" type="text" id="subject_name" value="{{ old('subject_name', optional($schoolSubject)->subject_name) }}" minlength="1" placeholder="Enter subject name here...">
        {!! $errors->first('subject_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>