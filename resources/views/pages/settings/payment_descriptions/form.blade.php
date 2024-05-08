<div class="row mb-5">
    <div class="form-group {{ $errors->has('charge_type') ? 'has-error' : '' }}">
        <label for="charge_type" class="control-label">Payment Description</label>
        <div class="col-md-12">
            <input class="form-control" name="payment_description" type="text" id="payment_description" value="{{ old('payment_description', optional($paymentDescription)->payment_description) }}" placeholder="Enter payment description here...">
            {!! $errors->first('payment_description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>