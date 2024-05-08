<div class="row mb-5">
    <div class="form-group {{ $errors->has('charge_type') ? 'has-error' : '' }}">
        <label for="charge_type" class="control-label">Student Charge Type</label>
        <div class="col-md-12">
            <input class="form-control" name="charge_type" type="text" id="charge_type" value="{{ old('charge_type', optional($studentChargeType)->charge_type) }}" placeholder="Enter charge type here...">
            {!! $errors->first('charge_type', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            <label for="status" class="control-label required">Status</label>

            <select class="form-control" id="status" name="status" required>
                <option value="" style="display: none;" {{ old('status', optional($studentChargeType)->status ?: '') == '' ? 'selected' : '' }} disabled selected>Select suppression type</option>
                @foreach ($statusTypes as $key => $statusType)
                <option value="{{ $key }}" {{ old('status', optional($studentChargeType)->status) == $key ? 'selected' : '' }}>
                    {{ $statusType }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>