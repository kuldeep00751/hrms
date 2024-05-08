 <div class="card">
     <!--begin::Card header-->
     <div class="card-header border-0">
         <!--begin::Card title-->
         <div class="card-title m-0">
             <h3 class="fw-bolder m-0">{{ __('Employee Profile Details') }}</h3>
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
                 <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Passport Photo') }}</label>
                 <div class="col-lg-8">
                     <div class="image-input image-input-outline {{ isset($info) && $employee->passport_photo ? '' : 'image-input-empty' }}" data-kt-image-input="true" style="background-image: url({{ asset(theme()->getMediaUrlPath() . 'avatars/blank.png') }})">
                         @if(isset($info) && $employee->passport_photo )
                         <div class="image-input-wrapper w-125px h-125px" style="background-image: {{ asset('storage/'.$employee->passport_photo) }};"></div>
                         @else
                         <div class="image-input-wrapper w-125px h-125px" style="background-image: none;"></div>
                         @endif
                         <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                             <i class="bi bi-pencil-fill fs-7"></i>

                             <input type="file" name="passport_photo" accept=".png, .jpg, .jpeg" />
                             <input type="hidden" name="avatar_remove" />
                         </label>
                         <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                             <i class="bi bi-x fs-2"></i>
                         </span>
                         <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                             <i class="bi bi-x fs-2"></i>
                         </span>
                     </div>

                     <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                 </div>
             </div>

             <!--begin::Input group-->
             <div class="row mb-6">
                 <!--begin::Label-->
                 <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Title') }}</label>
                 <!--end::Label-->

                 <!--begin::Col-->
                 <div class="col-lg-8">
                     <!--begin::Row-->
                     <div class="row">
                         <!--begin::Col-->
                         <div class="col-lg-6 fv-row">

                             <select name="title_id" aria-label="{{ __('Select Title') }}" data-placeholder="{{ __('Select title...') }}" class="form-select form-select-solid form-select-lg fw-bold" data-label="Title" required>
                                 <option value="">{{ __('Select Title...') }}</option>
                                 @foreach($titles as $key => $value)
                                 <option value="{{ $key }}" {{ $key === old('title_id', $employee->title_id ?? '') ? 'selected' :'' }}>{{ $value }}</option>
                                 @endforeach
                             </select>
                         </div>
                         <!--end::Col-->


                     </div>
                     <!--end::Row-->
                 </div>
                 <!--end::Col-->
             </div>
             <!--end::Input group-->

             <!--begin::Input group-->
             <div class="row mb-6">
                 <!--begin::Label-->
                 <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Full name') }}</label>
                 <!--end::Label-->

                 <!--begin::Col-->
                 <div class="col-lg-8">
                     <!--begin::Row-->
                     <div class="row">
                         <!--begin::Col-->
                         <div class="col-lg-6 fv-row">
                             <input type="text" name="surname" class="form-control form-control-lg form-control-solid" placeholder="Surname" value="{{ old('surname', $employee->surname ?? '') }}" data-label="Surname" required />
                         </div>
                         <!--end::Col-->
                         <!--begin::Col-->
                         <div class="col-lg-6 fv-row">
                             <input type="text" name="first_names" class="form-control form-control-lg form-control-solid" placeholder="Enter all your names" value="{{ old('first_names', $employee->first_names ?? '') }}" data-label="First Name" required />
                         </div>
                         <!--end::Col-->
                     </div>
                     <!--end::Row-->
                 </div>
                 <!--end::Col-->
             </div>
             <!--end::Input group-->
             <!--begin::Input group-->
             <div class="row mb-6">
                 <!--begin::Label-->
                 <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Maiden Name') }}</label>
                 <!--end::Label-->
                 <!--begin::Col-->
                 <div class="col-lg-8">
                     <!--begin::Row-->
                     <div class="row">

                         <!--begin::Col-->
                         <div class="col-lg-6 fv-row">
                             <input type="text" name="maiden_name" class="form-control form-control-lg form-control-solid" placeholder="Maiden name" value="{{ old('maiden_name', $employee->maiden_name ?? '') }}" data-label="Maiden Name" />
                         </div>
                         <!--end::Col-->
                         <!--begin::Col-->
                         <div class="col-lg-6 fv-row">
                             <select name="marital_status_id" aria-label="{{ __('Select Marital Status') }}" data-placeholder="{{ __('Select Marital Status...') }}" class="form-select form-select-solid form-select-lg fw-bold" data-label="Marital Status" required>
                                 <option value="">{{ __('Select Marital Status...') }}</option>
                                 @foreach($maritalStatuses as $key => $value)
                                 <option value="{{ $key }}" {{ $key === old('marital_status_id', $employee->marital_status_id ?? '') ? 'selected' :'' }}>{{ $value }}</option>
                                 @endforeach
                             </select>
                         </div>
                         <!--end::Col-->
                     </div>
                     <!--end::Row-->
                 </div>
                 <!--end::Col-->
             </div>
             <!--end::Input group-->
             <!--begin::Input group-->
             <div class="row mb-6">
                 <!--begin::Label-->
                 <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Gender & Date of Birth') }}</label>
                 <!--end::Label-->

                 <!--begin::Col-->
                 <div class="col-lg-8">
                     <!--begin::Row-->
                     <div class="row">
                         <!--begin::Col-->
                         <div class="col-lg-6 fv-row">

                             <select name="gender_id" aria-label="{{ __('Select your Gender') }}" data-placeholder="{{ __('Select your Gender...') }}" class="form-select form-select-solid form-select-lg fw-bold" data-label="Gender" required>
                                 <option value="">{{ __('Select your Gender...') }}</option>
                                 @foreach($genderTypes as $key => $value)
                                 <option value="{{ $key }}" {{ $key === old('gender_id', $employee->gender_id ?? '') ? 'selected' :'' }}>{{ $value }}</option>
                                 @endforeach
                             </select>
                         </div>
                         <!--end::Col-->
                         <!--begin::Col-->
                         <div class="col-lg-6 fv-row">
                             <input type="text" id="date_of_birth" name="date_of_birth" data-inputmask="'mask': '9999-99-99'" class="form-control form-control-lg form-control-solid" placeholder="Format: YYYY-MM-D" value="{{ old('date_of_birth', $employee->date_of_birth ?? '') }}" data-label="Date of Birth" required />
                         </div>
                         <!--end::Col-->
                     </div>
                     <!--end::Row-->
                 </div>
                 <!--end::Col-->
             </div>
             <!--end::Input group-->
             <!--begin::Input group-->
             <div class="row mb-6">
                 <!--begin::Label-->
                 <label class="col-lg-4 col-form-label fw-bold fs-6">
                     <span class="">{{ __('ID / Passport Number') }}</span>

                     <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('ID / Passport Number') }}"></i>
                 </label>
                 <!--end::Label-->

                 <!--begin::Col-->
                 <div class="col-lg-8 fv-row">
                     <input type="text" name="id_password" class="form-control form-control-lg form-control-solid" placeholder="ID Number" value="{{ old('id_password', $employee->id_password ?? '') }}" data-label="ID or Passport Number"  />
                 </div>
                 <!--end::Col-->
             </div>
             <!--end::Input group-->

             <!--begin::Input group-->
             <div class="row mb-6">
                 <!--begin::Label-->
                 <label class="col-lg-4 col-form-label fw-bold fs-6">
                     <span class="">{{ __('Social Security No.') }}</span>

                     <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Social Security No.') }}"></i>
                 </label>
                 <!--end::Label-->

                 <!--begin::Col-->
                 <div class="col-lg-8 fv-row">
                     <input type="text" name="ssc_number" class="form-control form-control-lg form-control-solid" placeholder="Social Security No." data-label="Social Security No." value="{{ old('ssc_number', $employee->ssc_number ?? '') }}" />
                 </div>
                 <!--end::Col-->
             </div>
             <!--end::Input group-->
             
             <!--begin::Input group-->
             <div class="row mb-6">
                 <!--begin::Label-->
                 <label class="col-lg-4 col-form-label fw-bold fs-6">
                     <span class="">{{ __('Tax Number') }}</span>

                     <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('TIN') }}"></i>
                 </label>
                 <!--end::Label-->

                 <!--begin::Col-->
                 <div class="col-lg-8 fv-row">
                     <input type="number" name="tax_number" class="form-control form-control-lg form-control-solid" placeholder="Tax number" data-label="Tax number" value="{{ old('tax_number', $employee->tax_number ?? '') }}"  />
                 </div>
                 <!--end::Col-->
             </div>
             <!--end::Input group-->

             <!--begin::Input group-->
             <div class="row mb-6">
                 <!--begin::Label-->
                 <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Employee Number') }}</label>
                 <!--end::Label-->

                 <!--begin::Col-->
                 <div class="col-lg-8 fv-row">

                     <input type="number" name="employee_number" class="form-control form-control-lg form-control-solid mb-2" placeholder="Employee Number" data-label="Employee Number" value="{{ old('employee_number', $employee->employee_number ?? '') }}" />
                     <div class="help-block alert alert-warning text-black">
                         <strong>Please note:</strong> When left blank, the system will auto generate the employee number. Please note that number is forever.
                     </div>
                 </div>
                 <!--end::Col-->
             </div>
             <!--end::Input group-->
             <div class="row mb-6">
                 <!--begin::Label-->
                 <label class="col-lg-4 col-form-label fw-bold fs-6 required">{{ __('Accumulative Leave') }}</label>
                 <!--end::Label-->

                 <!--begin::Col-->
                 <div class="col-lg-8 fv-row">

                    <select name="accumulative_leave_id" aria-label="{{ __('Select Accumulative Leave') }}" data-placeholder="{{ __('Select Accumulative Leave...') }}" class="form-select form-select-solid form-select-lg fw-bold" data-label="Accumulative Leave" required>
                        <option value="">{{ __('Select Accumulative Leave...') }}</option>
                        @foreach($accumulativeleave as $key => $value)
                        <option value="{{ $key }}" {{ $key === old('accumulative_leave_id', $employee->accumulative_leave_id ?? '') ? 'selected' :'' }}>{{ $value }}</option>
                        @endforeach
                    </select>  
                 </div>
                 <!--end::Col-->
             </div>
         </div>
         <!--end::Card body-->

     </div>
     <!--end::Content-->
 </div>