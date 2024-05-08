<div class="mb-5 form-group {{ $errors->has('academic_year_id') ? 'has-error' : '' }}">
    <label for="academic_year_id" class="control-label">Academic Year <span class="text-danger">*</span></label>
    <div class="col-md-12">
        
        {!! $errors->first('academic_year_id', '<p class="help-block">:message</p>') !!}
        <select class="form-control" name="academic_year_id">
            <option>-Select-</option>
            @foreach($academicYears as $key => $value)
            <option value="{{ $key }}" {{ $key === optional($academicProcess)->academic_year_id ? 'selected' :'' }}>{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('process_name') ? 'has-error' : '' }}">
    <label for="start_date" class="control-label">Process Name <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="process_name" type="text" id="process_name" value="{{ $academicProcessType->process_type }}" readonly>
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('academic_intake_id') ? 'has-error' : '' }}">
    <label for="academic_intake_id" class="control-label">Academic Intake <span class="text-danger">*</span></label>
    <div class="col-md-12">
        {!! $errors->first('academic_intake_id', '<p class="help-block">:message</p>') !!}
        <select class="form-control" name="academic_intake_id">
            <option>-Select-</option>
            @foreach($academicIntakes as $key => $value)
            <option value="{{$key}}" {{ ($key == optional($academicProcess)->academic_intake_id) ? 'selected' :'' }}>{{$value}}</option>
            @endforeach
        </select>
    </div>
</div>


<div class="mb-5 form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
    <label for="start_date" class="control-label">Start Date <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="start_date" type="date" id="start_date" value="{{ old('start_date', optional($academicProcess)->start_date) }}" placeholder="Enter start date here...">
        {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
    <label for="end_date" class="control-label">End Date <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="end_date" type="date" id="end_date" value="{{ old('end_date', optional($academicProcess)->end_date) }}" placeholder="Enter end date here...">
        {!! $errors->first('end_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>