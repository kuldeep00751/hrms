<div class="card">
     <!--begin::Card header-->
     <div class="card-header border-0">
         <!--begin::Card title-->
         <div class="card-title m-0">
             <h3 class="fw-bolder m-0">{{ __('Employee Employment Data') }}</h3>
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
                    <span>{{ __('Campus') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <select name="campus" aria-label="{{ __('Select Campus') }}" data-placeholder="{{ __('Select Campus...') }}" class="form-select form-select-solid form-select-lg fw-bold" data-label="Select Campus">
                        <option value="">{{ __('Select Campus...') }}</option>
                        @foreach($campus as $key => $value)
                        <option value="{{ $key }}" {{ $key === old('campus', (int)$employee->campus ?? '') ? 'selected' :'' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <!--end::Col-->
            </div>

            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-bold fs-6">
                    <span>{{ __('Department') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <select name="department" aria-label="{{ __('Select Department') }}" data-placeholder="{{ __('Select Department...') }}" class="form-select form-select-solid form-select-lg fw-bold" data-label="Select Department" required>
                        <option value="">{{ __('Select Department...') }}</option>
                        @foreach($department as $key => $value)
                        <option value="{{ $key }}" {{ $key === old('department', (int)$employee->department ?? '') ? 'selected' :'' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span>{{ __('Designation') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <select name="designation" aria-label="{{ __('Select Designation') }}" data-placeholder="{{ __('Select Designation...') }}" class="form-select form-select-solid form-select-lg fw-bold" data-label="Select Designation">
                        <option value="">{{ __('Select Designation...') }}</option>
                        @foreach($designation as $key => $value)
                        <option value="{{ $key }}" {{ $key === old('designation', (int)$employee->designation ?? '') ? 'selected' :'' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-6">
                 <!--begin::Label-->
                 <label class="col-lg-4 col-form-label fw-bold fs-6 required">{{ __('Start date & End date') }}</label>
                 <!--end::Label-->

                 <!--begin::Col-->
                 <div class="col-lg-8">
                     <!--begin::Row-->
                     <div class="row">
                         <!--begin::Col-->
                         <div class="col-lg-6 fv-row">
                            <input type="date" id="start_date" name="start_date"  class="form-control form-control-lg form-control-solid" placeholder="Start Date: YYYY-MM-D" value="{{ old('start_date', $employee->start_date ?? '') }}" data-label="Start Date" required/>
                         </div>
                         <!--end::Col-->
                         <!--begin::Col-->
                         <div class="col-lg-6 fv-row">
                             <input type="date" id="end_date" name="end_date"  class="form-control form-control-lg form-control-solid" placeholder="End Date: YYYY-MM-D" value="{{ old('end_date', $employee->end_date ?? '') }}" data-label="End Date" required/>
                         </div>
                         <!--end::Col-->
                     </div>
                     <!--end::Row-->
                 </div>
                 <!--end::Col-->
            </div>
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-bold fs-6">
                    <span>{{ __('Employment Status') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <select name="employment_status" aria-label="{{ __('Select Employment Status') }}" data-placeholder="{{ __('Select Employment Status...') }}" class="form-select form-select-solid form-select-lg fw-bold" data-label="Select Employment Status" required>
                        <option value="">{{ __('Select Employment Status...') }}</option>
                        @foreach($employmentStatus as $key => $value)
                        <option value="{{ $key }}" {{ $key === old('employment_status', (int)$employee->employment_status ?? '') ? 'selected' :'' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span>{{ __('Highest Qualification') }}</span>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <select name="highest_qualification" aria-label="{{ __('Select Highest Qualification') }}" data-placeholder="{{ __('Select Highest Qualification...') }}" class="form-select form-select-solid form-select-lg fw-bold" data-label="Select Highest Qualification">
                        <option value="">{{ __('Select Highest Qualification...') }}</option>
                        @foreach($highest_qualification as $key => $value)
                        <option value="{{ $key }}" {{ $key === old('highest_qualification', (int)$employee->highest_qualification ?? '') ? 'selected' :'' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span>{{ __('Bank account details') }}</span>
                </label>
                <!--end::Label-->
            </div>
            <div class="row mb-6">
                <!--begin::Col-->
                <div class="col-lg-12">
                     <!--begin::Row-->
                     <div class="row">
                         <!--begin::Col-->
                         <div class="col-lg-6 fv-row">
                            <select name="bank_name" aria-label="{{ __('Select Banks') }}" data-placeholder="{{ __('Select Banks...') }}" class="form-select form-select-solid form-select-lg fw-bold" data-label="Select Banks">
                                <option value="">{{ __('Select Banks...') }}</option>
                                @foreach($banks as $key => $value)
                                <option value="{{ $key }}" {{ $key === old('bank_name', (int)$employee->bank_name ?? '') ? 'selected' :'' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                         <!--end::Col-->
                         <!--begin::Col-->
                         <div class="col-lg-6 fv-row">
                             <input type="number" id="account_number" name="account_number" class="form-control form-control-lg form-control-solid" placeholder="Account Number" value="{{ old('account_number', $employee->account_number ?? '') }}" data-label="Account Number"/>
                         </div>
                         <!--end::Col-->
                     </div>
                     <!--end::Row-->
                 </div>
                 
                <!--end::Col-->
            </div>
            <div class="row mb-6">
                <!--begin::Col-->
                <div class="col-lg-12">
                     <!--begin::Row-->
                     <div class="row">
                         <!--begin::Col-->
                         <div class="col-lg-6 fv-row">
                            <input type="text" id="branch_code" name="branch_code"  class="form-control form-control-lg form-control-solid" placeholder="Code" value="{{ old('code', $employee->branch_code ?? '') }}" data-label="Code"/>
                         </div>
                         <!--end::Col-->
                         <!--begin::Col-->
                         <div class="col-lg-6 fv-row">
                            <select name="bank_account_type" aria-label="{{ __('Select Banks Account Type') }}" data-placeholder="{{ __('Select Bank Account Type...') }}" class="form-select form-select-solid form-select-lg fw-bold" data-label="Select Bank Account Type">
                                <option value="">{{ __('Select Bank Account Type...') }}</option>
                                @foreach($bank_account_types as $key => $value)
                                <option value="{{ $key }}" {{ $key === old('bank_account_type', (int)$employee->bank_account_type ?? '') ? 'selected' :'' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                         <!--end::Col-->
                     </div>
                     <!--end::Row-->
                 </div>
                 
                <!--end::Col-->
            </div>
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span>{{ __('Previous employment') }}</span>
                </label>
                <!--end::Label-->
                <div class="col-lg-12">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-6 fv-row">
                        <input type="text" id="company_name" name="company_name"  class="form-control form-control-lg form-control-solid" placeholder="Company name" value="{{ old('company_name', $employee->company_name ?? '') }}" data-label="Company name"/>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-lg-6 fv-row">
                            <input type="text" id="position" name="position"  class="form-control form-control-lg form-control-solid" placeholder="Position" value="{{ old('code', $employee->position ?? '') }}" data-label="Position"/>
                         </div>
                         <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
            </div>
            <div class="row mb-6">
                <!--begin::Col-->
                <div class="col-lg-12">
                     <!--begin::Row-->
                     <div class="row">
                         <!--begin::Col-->
                         <div class="col-lg-6 fv-row">
                             <input type="text" id="duration" name="duration"  class="form-control form-control-lg form-control-solid" placeholder="Duration (in months)" value="{{ old('type', $employee->duration ?? '') }}" data-label="Duration"/>
                         </div>
                         <!--end::Col-->
                     </div>
                     <!--end::Row-->
                 </div>
                 
                <!--end::Col-->
            </div>
         </div>
         <!--end::Card body-->

     </div>
     <!--end::Content-->
 </div>