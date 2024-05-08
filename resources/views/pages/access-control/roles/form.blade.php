<div class="form-group mb-5 {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="control-label">Role name</label>
    <div class="col-md-12">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($role)->name) }}" minlength="1" placeholder="Enter role name here..." required>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="control-label">Permissions</label>
    <div class="col-md-12">
        <select name="permissions[]" aria-label="{{ __('Permission') }}" data-placeholder="{{ __('Select permissions...') }}" data-control="select2" class="form-select form-select-solid fw-bold" multiple required>
            @foreach ($permissions as $key => $permission)
            <option value="{{ $key }}" {{ (in_array($permission, $assignedPermissions)) ? 'selected' : '' }}>
                {{ $permission }}
            </option>
            @endforeach
        </select>
    </div>
</div>