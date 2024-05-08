<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <a href="/system/settings#general" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                </div>
                <div class="pull-right">
                    <h3>Institution Information</h3>
                </div>
            </div>

            <form method="POST" action="{{ route('company_setups.company_setup.store') }}" accept-charset="UTF-8" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                    @php
                    $allowed_academic_applications = $lovs->where('label', 'ALLOWED_NUMBER_OF_ACADEMIC_APPLICATIONS')->first();
                    @endphp

                    <input class="form-control" name="ALLOWED_NUMBER_OF_ACADEMIC_APPLICATIONS" type="hidden" value="{{ old('allowed_academic_applications', $allowed_academic_applications->value) }}">

                    @php
                    $charge_type = $lovs->where('label', 'REGISTRATION_FEE_CHARGE_TYPE')->first();
                    @endphp

                    <input class="form-control" name="REGISTRATION_FEE_CHARGE_TYPE" type="hidden" value="{{ $charge_type->value }}">
                    <div class="row mb-5">
                        @php
                        $company_name = $lovs->where('label', 'COMPANY_NAME')->first();

                        @endphp
                        <label class="mb-3">Institution Name</label>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input class="form-control" name="COMPANY_NAME" type="text" value="{{ old('company_name', $company_name->value) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        @php
                        $company_address_1 = $lovs->where('label', 'COMPANY_ADDRESS_1')->first();
                        $company_address_2 = $lovs->where('label', 'COMPANY_ADDRESS_2')->first();
                        $company_address_3 = $lovs->where('label', 'COMPANY_ADDRESS_3')->first();
                        @endphp
                        <label class="mb-3">Address</label>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input class="form-control mb-1" name="COMPANY_ADDRESS_1" type="text" value="{{ old('company_address_1', $company_address_1->value) }}" placeholder="Address Line 1">
                                <input class="form-control mb-1" name="COMPANY_ADDRESS_2" type="text" value="{{ old('company_address_2', $company_address_2->value) }}" placeholder="Address Line 2">
                                <input class="form-control mb-1" name="COMPANY_ADDRESS_3" type="text" value="{{ old('company_address_3', $company_address_3->value) }}" placeholder="Address Line 3">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        @php
                        $company_contact_number = $lovs->where('label', 'COMPANY_CONTACT_NUMBER')->first();

                        @endphp
                        <label class="mb-3">Contact Number</label>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input class="form-control" name="COMPANY_CONTACT_NUMBER" type="number" value="{{ old('company_contact_number', $company_contact_number->value) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        @php
                        $company_email = $lovs->where('label', 'COMPANY_EMAIL')->first();

                        @endphp
                        <label class="mb-3">Email</label>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input class="form-control" name="COMPANY_EMAIL" type="email" value="{{ old('company_email', $company_email->value) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        @php
                        $company_fax = $lovs->where('label', 'COMPANY_FAX')->first();

                        @endphp
                        <label class="mb-3">Fax</label>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input class="form-control" name="COMPANY_FAX" type="number" value="{{ old('company_fax', $company_fax->value) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <label class="mb-3">Institution Logo</label>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input class="form-control" name="logo" type="file">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">

                        <a href="/system/settings#general">
                            Cancel
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-base-layout>