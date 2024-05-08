<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('device_type') ? 'has-error' : '' }}">
            <label for="device_type" class="control-label">Student Device Type <span class="text-danger">*</span></label>
            <input class="form-control" name="device_type" type="text" value="{{ old('device_type', optional($studentDeviceType)->device_type) }}" placeholder="Enter device type name here...">
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('valid_months') ? 'has-error' : '' }}">
            <label for="valid_months" class="control-label">How many months is this device valid? <span class="text-danger">*</span></label>
            <select class="form-control" id="valid_months" name="valid_months" required>
                <option value="" style="display: none;" {{ old('valid_months', optional($studentDeviceType)->valid_months ?: '') == '' ? 'selected' : '' }} disabled selected>Select months valid options</option>
                @foreach ($validMonthsOptions as $key => $validMonthsOption)
                <option value="{{ $key }}" {{ old('valid_months', optional($validMonthsOptions)->valid_months) == $key ? 'selected' : '' }}>
                    {{ $validMonthsOption }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('replaceable') ? 'has-error' : '' }}">
            <label for="replaceable" class="control-label">Replaceable <span class="text-danger">*</span></label>

            <select class="form-control" id="replaceable" name="replaceable" required>
                <option value="" style="display: none;" {{ old('replaceable', optional($validMonthsOptions)->replaceable ?: '') == '' ? 'selected' : '' }} disabled selected>Select replaceable option</option>
                @foreach ($replaceableOptions as $key => $replaceableOption)
                <option value="{{ $key }}" {{ old('replaceable', optional($studentDeviceType)->replaceable) == $key ? 'selected' : '' }}>
                    {{ $replaceableOption }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>