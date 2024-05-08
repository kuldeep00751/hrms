<x-base-layout>
    <div class="col-md-10 mx-auto">
        <div class="card mb-5">
            <div class="card-header">
                <div class="pull-left">
                    <a href="{{ route('employees.employee.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Employees </a>
                </div>
                <div class="pull-right">
                    <a href="{{ route('employees.employee.edit', $employees->id) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-edit"></i> Update Profile </a>
                </div>
            </div>
           @include('hr.employees.nav')
        </div>
        <div class="card mb-5">
            <div class="card-header">
                <h6 class="fw-bolder m-0">Contact Information</h6>
            </div>
            <div class="card-body pt-9 pb-0">
                <div class="row">
                <div class="col-md-4 col-sm-12 b-r"> <strong>Mobile Number</strong>
                             <br>
                             <p class="text-muted">{{ optional($employees)->contact_number }}</p>
                         </div>
                    <div class="col-md-3 col-sm-12"> <strong>Postal Address</strong>
                        <p class="text-muted">
                            {{ optional($employees)->postal_address_line_1 }}<br>
                            {{ optional($employees)->postal_address_line_2 }}<br>
                            {{ optional($employees)->postal_address_line_3 }}<br>
                        </p>
                    </div>
                    <div class="col-md-3 col-sm-12"> <strong>Residential Address</strong>
                        <p class="text-muted">
                            {{ optional($employees)->residential_address_line_1 }}<br>
                            {{ optional($employees)->residential_address_line_2 }}<br>
                            {{ optional($employees)->residential_address_line_3 }}<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base-layout>