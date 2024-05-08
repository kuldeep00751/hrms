
<div class="form-group {{ $errors->has('relationship') ? 'has-error' : '' }}">
    <label for="relationship" class="control-label">Relationship <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="relationship" type="text" id="relationship" value="{{ old('relationship', optional($nextOfKinRelationship)->relationship) }}" minlength="1" placeholder="Enter relationship here...">
        {!! $errors->first('relationship', '<p class="help-block">:message</p>') !!}
    </div>
</div>

