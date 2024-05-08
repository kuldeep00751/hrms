<x-base-layout>
    <div class="col-md-10 mx-auto">


        <div class="card mb-5">
            <div class="card-header">
                <div class="pull-left">
                    <a href="{{ route('employees.employee.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Employee </a>
                </div>
                <div class="pull-right">
                    <a href="{{ route('employees.employee.edit', $employees->id) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-edit"></i> Update Profile </a>
                </div>
            </div>
            @include('hr.employees.nav')
        </div>

        <div class="card mb-5">
            <div class="card-header">
                <h6 class="fw-bolder m-0">Employee Account Information</h6>
            </div>
            <div class="card-body pt-9 pb-0">
                <form method="POST" action="{{ route('employees.employee.account_update', $employees->id) }}" accept-charset="UTF-8" class="form-horizontal">
                    <div class="card-body">
                        @if(Session::has('success_message'))
                        <div class="alert alert-success">
                            <h6 class="text-success">
                                <i class="fa-solid fa-circle-check text-success"></i>
                                {!! session('success_message') !!}
                            </h6>
                        </div>
                        @endif
                        
                        @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif

                        {{ csrf_field() }}
                        
                        <div class="mb-5 form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="last_name" class="control-label">Email <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input class="form-control" name="email" type="text" id="email" value="{{ old('email', $employees->email_address) }}" minlength="1" placeholder="Enter email here..." required autocomplete="off" autofill="off">
                            </div>
                        </div>
                        <div class="mb-5 form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="last_name" class="control-label">Password <span class="text-danger">*</span></label>
                            <div class="col-md-12 mb-4">
                                <input class="form-control" name="password" type="password" id="password" minlength="1">

                            </div>

                        </div>
                        <div class="mb-5 form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="last_name" class="control-label">Confirm Password <span class="text-danger">*</span></label>
                            <div class="col-md-12 mb-4">
                                <input class="form-control" name="password_confirmation" type="password" id="password" minlength="1">

                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <input class="btn btn-success" type="submit" value="Save">

                            <a href="{{ route('employees.employee.index') }}">
                                Cancel
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
</x-base-layout>