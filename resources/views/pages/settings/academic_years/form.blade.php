<div class="mb-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="control-label">Academic Year <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="name" type="number" id="name" value="{{ old('name', optional($academicYear)->name) }}" placeholder="Enter academic year here..." required>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('start') ? 'has-error' : '' }}">
    <label for="start" class="control-label">From date <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="start" type="date" id="start" value="{{ old('start', optional($academicYear)->start) }}" minlength="1" placeholder="Enter from date here..." required>
        {!! $errors->first('start', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('end') ? 'has-error' : '' }}">
    <label for="end" class="control-label">To date <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="end" type="date" id="end" value="{{ old('end', optional($academicYear)->end) }}" minlength="1" placeholder="Enter end here..." required>
        {!! $errors->first('end', '<p class="help-block">:message</p>') !!}
    </div>
</div>