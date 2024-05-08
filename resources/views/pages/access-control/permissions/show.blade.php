<x-base-layout>
    <div class="col-md-6 mx-auto">

        <div class="card">

            <div class="card-header">
                <div class="pull-left">
                    <a href="{{ route('permissions.permission.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Permissions</a>
                </div>
                <div class="pull-right">
                    <h3>{{ $permission->name }}</h3>
                </div>

            </div>

            <div class="card-body panel-body-with-table">
                <div class="table-responsive">
                    <div class="table-responsive">

                        <table class="table table-row-dashed">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Roles</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($permissionRoles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td> Permission not assigned to any role</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
</x-base-layout>