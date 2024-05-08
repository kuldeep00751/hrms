<x-base-layout>
    <div class="col-md-6 mx-auto">

        <div class="card">

            <div class="card-header">
                <h4>
                    Permissions
                </h4>
                <div class="pull-right">
                    <a href="{{ route('permissions.permission.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                </div>

            </div>

            @if(count($permissions) == 0)
            <div class="card-body text-center">
                <h4>No Permissions Available.</h4>
            </div>
            @else
            <div class="card-body panel-body-with-table">
                <div class="table-responsive">

                    @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <h6 class="text-success">
                            <i class="fa-solid fa-circle-check text-success"></i>
                            {!! session('success_message') !!}
                        </h6>
                    </div>
                    @endif
                    <div class="table-responsive">

                        <table class="table table-row-dashed">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Permission</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>

                                    <td>
                                        <a href="{{ route('permissions.permission.edit', $permission->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
                                        <a href="{{ route('permissions.permission.show', $permission->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Show</a>

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