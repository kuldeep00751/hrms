<div class="mb-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="control-label">Name <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($space)->name) }}" minlength="1" maxlength="255" placeholder="Enter name here...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="control-label">Description <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="description" type="text" id="description" value="{{ old('description', optional($space)->description) }}" minlength="1" maxlength="255" placeholder="Enter description here...">
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('capacity') ? 'has-error' : '' }}">
    <label for="capacity" class="control-label">Capacity <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="capacity" type="number" id="capacity" value="{{ old('capacity', optional($space)->capacity) }}" minlength="1" maxlength="255" placeholder="Enter capacity here...">
        {!! $errors->first('capacity', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="mb-5 form-group {{ $errors->has('campus_id') ? 'has-error' : '' }}">
    <label for="campus_id" class="control-label">Campus <span class="text-danger">*</span></label>
    <div class="col-md-12">

        <select class="form-control" id="campus_id" name="campus_id" required>
            <option value="" style="display: none;" {{ old('campus_id', optional($space)->campus_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select Campus</option>
            @foreach ($campuses as $key => $campus)
            <option value="{{ $key }}" {{ old('campus_id', optional($space)->campus_id == $key) ? 'selected' : '' }}>
                {{ $campus }}
            </option>
            @endforeach
        </select>

        {!! $errors->first('campus_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>