<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('payment_method') ? 'has-error' : '' }}">
            <label for="payment_method" class="control-label">Payment Method <span class="text-danger">*</span></label>
            <input class="form-control" name="payment_method" type="text" id="payment_method" value="{{ old('payment_method', optional($paymentMethod)->payment_method) }}">
        </div>
    </div>
</div>

<div class="alert alert-warning text-black">
    <p>
        Some payment methods especially Bank Deposits and EFTs have Proof of Payment (POP) reference numbers. The setting below allows you to control whether a POP reference number is required or not when capturig payments from students.
    </p>
</div>
<div class="form-group {{ $errors->has('payment_receipt_required') ? 'has-error' : '' }}">
    <label for="payment_receipt_required" class="control-label">Is the POP reference number required for this payment method?</label>
    <div class="col-md-12">
        <select class="form-control" id="payment_receipt_required" name="payment_receipt_required">
            @foreach ($paymentReceiptRequiredOptions as $key => $paymentReceiptRequiredOption)
            <option value="{{ $key }}" {{ old('payment_receipt_required', optional($paymentMethod)->payment_receipt_required) == $key ? 'selected' : '' }}>
                {{ $paymentReceiptRequiredOption }}
            </option>
            @endforeach
        </select>
    </div>
</div>