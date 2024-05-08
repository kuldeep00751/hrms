<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('fee_type_name') ? 'has-error' : '' }}">
            <label for="fee_type_name" class="control-label">Fee Type Name <span class="text-danger">*</span></label>
            <input class="form-control" name="fee_type_name" type="text" id="fee_type_name" value="{{ old('fee_type_name', optional($feeType)->fee_type_name) }}" placeholder="Enter fee type name here...">
        </div>
    </div>
</div>