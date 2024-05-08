<x-base-layout>
    <div class="col-md-6 mx-auto">

        <div class="card">


            <div class="card-header">

                <span class="pull-left">
                    <h4 class="mt-5 mb-5">Create New User</h4>
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
                    @include ('pages.access-control.users.form', [
                    'user' => null,
                    'assignedRoles' => [],
                    'assignedPermissions' => []
                    ])
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
</x-base-layout>