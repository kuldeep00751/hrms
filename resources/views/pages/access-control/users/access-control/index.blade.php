<x-base-layout>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">

                <span class="pull-left">
                    <h4 class="mt-5 mb-5">Assign Permissions</h4>
                </span>

            </div>
            <form method="POST" action="{{ route('users.store') }}" accept-charset="UTF-8" class="form-horizontal">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {{ csrf_field() }}
                    <div class="col-12 mt-4 mb-4">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search for roles or permissions...">
                    </div>
                    <div class="row mb-5">
                        @foreach ($roles as $role)
                        <div class="col-md-4 mb-5">
                            <div class="card  border-2 shadow">
                                <div class="card-header bg-secondary">
                                    <h3 class="card-title">{{ $role->name }}</h3>
                                    <div class="card-toolbar">
                                        <div class="form-check form-switch form-check-custom form-check-solid d-inline-flex flex-row justify-content-between">
                                            <input class="form-check-input align-items-end" type="checkbox" data-model="role" data-user="{{ $user->id }}" data-permission_or_role="{{ $role->name }}" {{ (in_array($role->id, $assignedRoles) || in_array($role->id, old('role', []))) ? 'checked' : '' }} />
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @foreach ($role->permissions as $permission)
                                    <div class="row mb-2">

                                        <div class="form-check form-switch form-check-custom form-check-solid d-inline-flex flex-row justify-content-between">
                                            <label class="form-check-label align-items-stretch px-3" for="flexSwitchDefault">
                                                {{ $permission->name }}
                                            </label>
                                            <input class="form-check-input align-items-end" type="checkbox" data-model="permission" data-user="{{ $user->id }}" data-permission_or_role="{{ $permission->name }}" {{ (in_array($permission->id, $assignedPermissions) || in_array($permission->id, old('permissions', []))) ? 'checked' : '' }} />
                                        </div>
                                    </div>

                                    @endforeach
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">
                        <a href="{{ route('users.index') }}">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('keyup', function(e) {
                const term = e.target.value.toLowerCase();
                const roles = document.querySelectorAll('.col-md-4');

                roles.forEach(role => {
                    const roleName = role.querySelector('.card-title').textContent.toLowerCase();
                    const permissions = role.querySelectorAll('.form-check-label');
                    let permissionsVisible = false;

                    permissions.forEach(permission => {
                        if (permission.textContent.toLowerCase().includes(term)) {
                            permission.closest('.row').style.display = '';
                            permissionsVisible = true;
                        } else {
                            permission.closest('.row').style.display = 'none';
                        }
                    });

                    if (roleName.includes(term) || permissionsVisible) {
                        role.style.display = '';
                    } else {
                        role.style.display = 'none';
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('.form-check-input').on('change', function() {
                let checkbox = $(this);
                let url = '';
                let model = checkbox.data('model');
                let permission_or_role = checkbox.data('permission_or_role');

                let userId = checkbox.data('user'); // Replace USER_ID with actual user ID.

                if (model == 'role') {
                    url = checkbox.is(':checked') ? '/user/assign-role' : '/user/remove-role';
                } else {
                    url = checkbox.is(':checked') ? '/user/assign-permission' : '/user/remove-permission';
                }

                console.log(permission_or_role);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        user_id: userId,
                        permission_or_role: permission_or_role,
                        _token: '{{ csrf_token() }}' // Laravel CSRF token
                    },
                    success: function(response) {
                        console.log(response.status);
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>


</x-base-layout>