<div class="mb-5 col-md-12">
    <div class="form-group {{ $errors->has('promoted') ? 'has-error' : '' }}">
        <label for="promoted" class="control-label">Promoted (Yes/No) <span class="text-danger">*</span></label>

        <select class="form-control" id="promoted" name="promoted" required>
            <option value="" style="display: none;" {{ old('promoted', optional($promotionStatus)->promoted ?: '') == '' ? 'selected' : '' }} disabled selected>Select number of years</option>
            @foreach ($promotedOptions as $key => $promotedOption)
            <option value="{{ $key }}" {{ old('promoted', optional($promotionStatus)->promoted) == $key ? 'selected' : '' }}>
                {{ $promotedOption }}
            </option>
            @endforeach
        </select>
        {!! $errors->first('promoted', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="mb-5 form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">Description</label>
    <div class="col-md-12">
        <textarea class="form-control" name="description" id="description" placeholder="Enter status description here...">{{ old('description', optional($promotionStatus)->description) }}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>