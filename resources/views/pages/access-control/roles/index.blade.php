<x-base-layout>
    <div class="col-md-8 mx-auto">

        <div class="card">

            <div class="card-header">

                <h4>
                    Roles
                </h4>

                <div class="pull-right">
                    <a href="{{ route('roles.role.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                </div>

            </div>

            @if(count($roles) == 0)
            <div class="card-body text-center">
                <h4>No Roles Available.</h4>
            </div>
            @else
            <div class="card-body panel-body-with-table">

                    @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <h6 class="text-success">
                            <i class="fa-solid fa-circle-check text-success"></i>
                            {!! session('success_message') !!}
                        </h6>
                    </div>
                    @endif
                    <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="table-responsive">

                            <table class="table table-hover table-bordered" id="kt_datatable_example">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                        <th>Role</th>
                                        <th>Permissions</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @forelse($role->permissions as $permission)
                                            <span class="badge badge-light-primary">
                                                {{ $permission->name }}
                                            </span>
                                            @empty
                                            <i>No permissions assigned</i>
                                            @endforelse
                                        </td>
                                        <td>
                                            <a href="{{ route('roles.role.edit', $role->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                @endif

            </div>
        </div>
    </div>
</x-base-layout>