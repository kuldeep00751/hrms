<div class="mb-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="control-label">Name <span class="text-danger">*</span></label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($campus)->name) }}" minlength="1" maxlength="255" placeholder="Enter name here...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('address_line_1') ? 'has-error' : '' }} mb-5">
    <label for="address_line_1" class="control-label">Address <span class="text-danger">*</span></label>
    <div class="col-md-10">
        <input class="form-control mb-3" name="address_line_1" type="text" id="address_line_1" value="{{ old('address_line_1', optional($campus)->address_line_1) }}" minlength="1" placeholder="Enter address line 1 here...">
        {!! $errors->first('address_line_1', '<p class="help-block">:message</p>') !!}

        <input class="form-control mb-3" name="address_line_2" type="text" id="address_line_2" value="{{ old('address_line_2', optional($campus)->address_line_2) }}" minlength="1" placeholder="Enter address line 2 here...">
        {!! $errors->first('address_line_2', '<p class="help-block">:message</p>') !!}

        <input class="form-control" name="address_line_3" type="text" id="address_line_3" value="{{ old('address_line_3', optional($campus)->address_line_3) }}" minlength="1" placeholder="Enter address line 3 here...">
        {!! $errors->first('address_line_3', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('address_line_1') ? 'has-error' : '' }}">
    <label for="bank_name" class="control-label">Banking Details </label>
    <div class="col-md-10">
        <input class="form-control mb-3" name="bank_name" type="text" id="bank_name" value="{{ old('bank_name', optional($campus)->bank_name) }}" minlength="1" placeholder="Bank name...">
        {!! $errors->first('bank_name', '<p class="help-block">:message</p>') !!}

        <input class="form-control mb-3" name="account_number" type="text" id="account_number" value="{{ old('account_number', optional($campus)->account_number) }}" minlength="1" placeholder="Bank account number...">
        {!! $errors->first('account_number', '<p class="help-block">:message</p>') !!}

        <input class="form-control mb-3" name="branch_name" type="text" id="branch_name" value="{{ old('branch_name', optional($campus)->branch_name) }}" minlength="1" placeholder="Branch name...">
        {!! $errors->first('branch_name', '<p class="help-block">:message</p>') !!}

        <input class="form-control mb-3" name="branch_code" type="text" id="branch_code" value="{{ old('branch_code', optional($campus)->branch_code) }}" minlength="1" placeholder="Branch code...">
        {!! $errors->first('branch_code', '<p class="help-block">:message</p>') !!}

        <input class="form-control" name="swift_code" type="text" id="swift_code" value="{{ old('swift_code', optional($campus)->swift_code) }}" minlength="1" placeholder="Swift code...">
        {!! $errors->first('swift_code', '<p class="help-block">:message</p>') !!}
    </div>
</div>