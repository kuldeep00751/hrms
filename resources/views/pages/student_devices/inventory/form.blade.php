<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('student_device_type_id') ? 'has-error' : '' }}">
            <label for="student_device_type_id" class="control-label">Device Type <span class="text-danger">*</span></label>
            <select class="form-control" id="student_device_type_id" name="student_device_type_id" required>
                <option value="" style="display: none;" {{ old('number_of_years', optional($studentDeviceInventory)->student_device_type_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select device type</option>
                @foreach ($studentDeviceTypes as $key => $studentDeviceType)
                <option value="{{ $key }}" {{ old('student_device_type_id', optional(optional($studentDeviceInventory))->student_device_type_id) == $key ? 'selected' : '' }}>
                    {{ $studentDeviceType }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('device_imei') ? 'has-error' : '' }}">
            <label for="device_imei" class="control-label">Device IMEI / Serial Number <span class="text-danger">*</span></label>
            <input class="form-control" name="device_imei" type="number" id="device_imei" value="{{ old('device_imei',optional($studentDeviceInventory)->device_imei) }}">
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <label for="description" class="control-label">Device Name / Description <span class="text-danger">*</span></label>
            <input class="form-control" name="description" type="text" id="description" value="{{ old('description', optional($studentDeviceInventory)->description) }}">
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <label for="remarks" class="control-label">Remarks </label>
            <textarea class="form-control" name="remarks">{{ old('remarks', optional($studentDeviceInventory)->remarks) }}</textarea>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            <label for="status" class="control-label">Status <span class="text-danger">*</span></label>
            <select class="form-control" id="status" name="status" required>
                <option value="" style="display: none;" {{ old('status', optional($studentDeviceInventory)->status ?: '') == '' ? 'selected' : '' }} disabled selected>Select device status option</option>
                @foreach ($deviceStatusOptions as $key => $deviceStatusOption)
                <option value="{{ $key }}" {{ old('status', optional(optional($studentDeviceInventory))->status) == $key ? 'selected' : '' }}>
                    {{ $deviceStatusOption }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>