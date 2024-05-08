<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">

            <div class="card-header">
                <div class="pull-left">
                    <a href="{{ route('employees.employee.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Employees</a>
                </div>

                <div class="pull-right" role="group">
                    <h4 class="mt-5 mb-5">Create New Employee Account</h4>
                </div>

            </div>
            <form method="POST" action="{{ route('employees.employee.store') }}" accept-charset="UTF-8" class="form-horizontal">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {{ csrf_field() }}
                    <div class="row mb-5 ">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                                <label for="first_name" class="control-label">First name <span class="text-danger">*</span></label>

                                <input class="form-control" name="first_name" type="text" id="first_name" value="{{ old('first_name') }}" minlength="1" placeholder="Enter first name here..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                                <label for="last_name" class="control-label">Surname <span class="text-danger">*</span></label>

                                <input class="form-control" name="last_name" type="text" id="last_name" value="{{ old('last_name') }}" minlength="1" placeholder="Enter surname here..." required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5 form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="last_name" class="control-label">Email <span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input class="form-control" name="email" type="text" id="email" value="{{ old('email') }}" minlength="1" placeholder="Enter email here..." required>
                        </div>
                    </div>
                    <div class="mb-5 form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="last_name" class="control-label">Password <span class="text-danger">*</span></label>
                        <div class="col-md-12 mb-4">
                            <input class="form-control" name="password" type="text" id="password" value="Employee@321" minlength="1" readonly>

                        </div>
                        <div class="help-block alert alert-info">
                            The system will prompt all employees to update their default passwords when they login for the first time.
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">

                        <a href="{{ route('user_infos.user_info.index') }}">
                            Cancel
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-base-layout>