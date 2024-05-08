<div class="mb-5 form-group {{ $errors->has('result_code') ? 'has-error' : '' }}">
    <label for="result_code" class="control-label">Result Code <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="result_code" type="text" id="result_code" value="{{ old('result_code', optional($assessmentResultCode)->result_code) }}" minlength="1" maxlength="3" placeholder="Enter result code here...">
        {!! $errors->first('result_code', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="mb-5 form-group {{ $errors->has('result_code_description') ? 'has-error' : '' }}">
    <label for="result_code_description" class="control-label">Result Code Description<span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="result_code_description" type="text" id="result_code_description" value="{{ old('result_code_description', optional($assessmentResultCode)->result_code_description) }}" minlength="1" maxlength="255" placeholder="Enter result code description here...">
        {!! $errors->first('result_code_description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('pass_fail') ? 'has-error' : '' }}">
            <label for="pass_fail" class="control-label">Pass/Fail <span class="text-danger">*</span></label>

            <select class="form-control" id="pass_fail" name="pass_fail" required>
                <option value="" style="display: none;" {{ old('pass_fail', optional($assessmentResultCode)->pass_fail ?: '') == '' ? 'selected' : '' }} disabled selected>Select </option>
                @foreach ($passFailOptions as $key => $passFailOption)
                <option value="{{ $key }}" {{ old('pass_fail', optional($assessmentResultCode)->pass_fail) == $key ? 'selected' : '' }}>
                    {{ $passFailOption }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('pass_fail', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>