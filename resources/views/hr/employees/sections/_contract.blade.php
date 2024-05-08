<div class="card">
     <!--begin::Card header-->
     <div class="card-header border-0">
         <!--begin::Card title-->
         <div class="card-title m-0">
             <h3 class="fw-bolder m-0">{{ __('Employee Contact Information') }}</h3>
         </div>
         <!--end::Card title-->
     </div>
     <!--begin::Card header-->

     <!--begin::Content-->
     <div id="kt_account_profile_details">
         <!--begin::Form-->

         <!--begin::Card body-->
        <div class="card-body border-top p-9">
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span>{{ __('Cell phone number') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">

                    <input type="number" name="cellphone_number" class="form-control form-control-lg form-control-solid mb-2" placeholder="Cell phone number" value="{{ old('cellphone_number', $employee->cellphone_number ?? '') }}" data-label="Cell phone number" />
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span>{{ __('Alternative Contact number') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">

                    <input type="number" name="contact_number" class="form-control form-control-lg form-control-solid mb-2" placeholder="Alternative Contact number" value="{{ old('contact_number', $employee->contact_number ?? '') }}" data-label="Alternative Contact number" />
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span>{{ __('Email Address') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">

                    <input type="email" name="email_address" class="form-control form-control-lg form-control-solid mb-2" placeholder="Email Address" value="{{ old('email_address', $employee->email_address ?? '') }}" data-label="Email Address" />
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span>{{ __('Postal Address') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">

                    <input type="text" name="postal_address_line_1" class="form-control form-control-lg form-control-solid mb-2" placeholder="Postal Address Line 1" value="{{ old('postal_address_line_1', $employee->postal_address_line_1 ?? '') }}" data-label="Postal Address Line 1" />
                    <input type="text" name="postal_address_line_2" class="form-control form-control-lg form-control-solid mb-2" placeholder="Postal Address Line 2" value="{{ old('postal_address_line_2', $employee->postal_address_line_2 ?? '') }}" data-label="Postal Address Line 2" />
                    <input type="text" name="postal_address_line_3" class="form-control form-control-lg form-control-solid" placeholder="Postal Address Line 3" value="{{ old('postal_address_line_3', $employee->postal_address_line_3 ?? '') }}" data-label="Postal Address Line 3" />
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span>{{ __('Next of kin Names') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">

                    <input type="text" name="next_of_kin_names" class="form-control form-control-lg form-control-solid mb-2" placeholder="Next of kin Names" value="{{ old('next_of_kin_names', $employee->next_of_kin_names ?? '') }}" data-label="Next of kin Names" />
                </div>
                <!--end::Col-->
            </div>

            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span>{{ __('Next of kin Relationship') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                             <select name="next_of_kin_relationship" aria-label="{{ __('Select Next of Kin Relationships') }}" data-placeholder="{{ __('Select Next of Kin Relationships...') }}" class="form-select form-select-solid form-select-lg fw-bold" data-label="Select Next of Kin Relationships">
                                 <option value="">{{ __('Select Next of Kin Relationships...') }}</option>
                                 @foreach($nextOfKinRelationships as $key => $value)
                                 <option value="{{ $key }}" {{ $key === old('next_of_kin_relationship', (int)$employee->next_of_kin_relationship ?? '') ? 'selected' :'' }}>{{ $value }}</option>
                                 @endforeach
                             </select>
                         </div>
                <!--end::Col-->
            </div>

            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span>{{ __('Next of Kin Contact number') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">

                    <input type="number" name="next_of_kin_contact_number" class="form-control form-control-lg form-control-solid mb-2" placeholder="Next of Kin Contact number" value="{{ old('next_of_kin_contact_number', $employee->next_of_kin_contact_number ?? '') }}" data-label="Next of Kin Contact number" />
                </div>
                <!--end::Col-->
            </div>
        </div>
         <!--end::Card body-->

     </div>
     <!--end::Content-->
 </div>