<div class="row mb-5">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
            <label for="first_name" class="control-label">First Name</label>

            <input class="form-control" name="first_name" type="text" id="first_name" value="{{ old('first_name', optional($user)->first_name) }}" minlength="1" placeholder="Enter first name here...">
            {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
            <label for="last_name" class="control-label">Last Name</label>

            <input class="form-control" name="last_name" type="text" id="last_name" value="{{ old('last_name', optional($user)->last_name) }}" minlength="1" placeholder="Enter last name here...">
            {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group mb-5 {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email" class="control-label">Email</label>
    <div class="col-md-12">
        <input class="form-control" name="email" type="email" id="email" value="{{ old('email', optional($user)->email) }}" minlength="1" placeholder="Enter email here...">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group mb-5 {{ $errors->has('username') ? 'has-error' : '' }}">
    <label for="first_name" class="control-label">Password</label>
    <div class="col-md-12 mb-2">
        <input class="form-control" name="password" type="password" id="password" value="" minlength="1">
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}

    </div>
    <div class="help-block alert-info alert">
        The password field can be left blank. Only fill it in if you wish to change/update the user's password.
    </div>

</div>

<div class="form-group mb-5 {{ $errors->has('username') ? 'has-error' : '' }}">
    <label for="first_name" class="control-label">Confirm Password</label>
    <div class="col-md-12">
        <input class="form-control" name="password_confirmation" type="password" id="password" value="" minlength="1">
        {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<script>
    // Get all the role checkboxes
    const roleCheckboxes = document.querySelectorAll('input[name="role[]"]');

    // Loop through each role checkbox and attach a click event listener to it
    roleCheckboxes.forEach(function(roleCheckbox) {
        roleCheckbox.addEventListener('click', function() {
            // Get the row that contains the role checkbox
            const roleRow = roleCheckbox.closest('tr');
            // Get all the rows underneath the role row
            const rows = roleRow.nextElementSibling.querySelectorAll('tr');
            // Loop through each row and find the permission checkbox
            rows.forEach(function(row) {
                const permissionCheckbox = row.querySelector('input[name="permissions[]"]');
                if (permissionCheckbox) {
                    // Check or uncheck the permission checkbox based on the state of the role checkbox
                    permissionCheckbox.checked = roleCheckbox.checked;
                }
            });
        });
    });
</script>