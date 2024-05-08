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
                     <div class="image-input image-input-outline {{ isset($info) && $info->passport_photo ? '' : 'image-input-empty' }}" data-kt-image-input="true" style="background-image: url({{ asset(theme()->getMediaUrlPath() . 'avatars/blank.png') }})">
                         @if(isset($info) && $info->passport_photo )
                         <div class="image-input-wrapper w-125px h-125px" style="background-image: {{ asset('storage/'.$info->passport_photo) }};"></div>
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

                             <select name="title_id" aria-label="{{ __('Select your Title') }}" data-placeholder="{{ __('Select your title...') }}" class="form-select form-select-solid form-select-lg fw-bold" data-label="Title" required>
                                 <option value="">{{ __('Select your Title...') }}</option>
                                 @foreach($titles as $key => $value)
                                 <option value="{{ $key }}" {{ $key === old('title_id', $info->title_id ?? '') ? 'selected' :'' }}>{{ $value }}</option>
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
                             <input type="text" name="surname" class="form-control form-control-lg form-control-solid" placeholder="Surname" value="{{ old('surname', $info->surname ?? '') }}" data-label="Surname" required />
                         </div>
                         <!--end::Col-->
                         <!--begin::Col-->
                         <div class="col-lg-6 fv-row">
                             <input type="text" name="first_names" class="form-control form-control-lg form-control-solid" placeholder="Enter all your names" value="{{ old('first_names', $info->first_names ?? '') }}" data-label="First Name" required />
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
                             <input type="text" name="maiden_name" class="form-control form-control-lg form-control-solid" placeholder="Maiden name" value="{{ old('maiden_name', auth()->user()->maiden_name ?? '') }}" data-label="Maiden Name" />
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
                                 <option value="{{ $key }}" {{ $key === old('gender_id', $info->gender_id ?? '') ? 'selected' :'' }}>{{ $value }}</option>
                                 @endforeach
                             </select>
                         </div>
                         <!--end::Col-->
                         <!--begin::Col-->
                         <div class="col-lg-6 fv-row">
                             <input type="text" name="date_of_birth" data-inputmask="'mask': '9999-99-99'" class="form-control form-control-lg form-control-solid" placeholder="Format: YYYY-MM-D" value="{{ old('date_of_birth', $info->date_of_birth ?? '') }}" data-label="Date of Birth" required />
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
                     <span class="required">{{ __('ID / Passport Number') }}</span>

                     <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('ID / Passport Number') }}"></i>
                 </label>
                 <!--end::Label-->

                 <!--begin::Col-->
                 <div class="col-lg-8 fv-row">
                     <input type="text" name="id_number" class="form-control form-control-lg form-control-solid" placeholder="ID Number" value="{{ old('id_number', $info->id_number ?? '') }}" data-label="ID or Passport Number" required />
                 </div>
                 <!--end::Col-->
             </div>
             <!--end::Input group-->

             <!--begin::Input group-->
             <div class="row mb-6">
                 <!--begin::Label-->
                 <label class="col-lg-4 col-form-label fw-bold fs-6">
                     <span class="">{{ __('Social Security No.') }}</span>

                     <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('NTA / HCN Candidate No.') }}"></i>
                 </label>
                 <!--end::Label-->

                 <!--begin::Col-->
                 <div class="col-lg-8 fv-row">
                     <input type="text" name="nta_candidate_number" class="form-control form-control-lg form-control-solid" placeholder="NTA / HCN Candidate No." data-label="NTA / HCN Candidate No." value="{{ old('nta_candidate_number', $info->nta_candidate_number ?? '') }}" />
                 </div>
                 <!--end::Col-->
             </div>
             <!--end::Input group-->

             <!--begin::Input group-->
             <div class="row mb-6">
                 <!--begin::Label-->
                 <label class="col-lg-4 col-form-label fw-bold fs-6">
                     <span class="required">{{ __('Mobile Number') }}</span>

                     <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Number must be active') }}"></i>
                 </label>
                 <!--end::Label-->

                 <!--begin::Col-->
                 <div class="col-lg-8 fv-row">
                     <input type="tel" name="mobile_number" class="form-control form-control-lg form-control-solid" placeholder="Mobile number" data-label="Mobile number" value="{{ old('mobile_number', $info->mobile_number ?? '') }}" required />
                 </div>
                 <!--end::Col-->
             </div>
             <!--end::Input group-->

             <!--begin::Input group-->
             <div class="row mb-6">
                 <!--begin::Label-->
                 <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Email Address') }}</label>
                 <!--end::Label-->

                 <!--begin::Col-->
                 <div class="col-lg-8 fv-row">
                     <input type="email" name="email_address" class="form-control form-control-lg form-control-solid" placeholder="Email address" data-label="Email address" value="{{ old('email_address', $info->email_address ?? '') }}" readonly />
                 </div>
                 <!--end::Col-->
             </div>
             <!--end::Input group-->



             <div class="row mb-6">
                 <!--begin::Label-->
                 <label class="col-lg-4 col-form-label fw-bold fs-6">
                     <span>{{ __('Postal Address') }}</span>

                     <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Namibian, permanent residence, foreigner') }}"></i>
                 </label>
                 <!--end::Label-->

                 <!--begin::Col-->
                 <div class="col-lg-8 fv-row">

                     <input type="text" name="postal_address_line_1" class="form-control form-control-lg form-control-solid mb-2" placeholder="Postal Address Line 1" value="{{ old('postal_address_line_1', $info->postal_address_line_1 ?? '') }}" data-label="Postal Address Line 1" />
                     <input type="text" name="postal_address_line_2" class="form-control form-control-lg form-control-solid mb-2" placeholder="Postal Address Line 2" value="{{ old('postal_address_line_2', $info->postal_address_line_2 ?? '') }}" data-label="Postal Address Line 2" />
                     <input type="text" name="postal_address_line_3" class="form-control form-control-lg form-control-solid" placeholder="Postal Address Line 3" value="{{ old('postal_address_line_3', $info->postal_address_line_3 ?? '') }}" data-label="Postal Address Line 3" />
                 </div>
                 <!--end::Col-->
             </div>
             <!--end::Input group-->

             <div class="row mb-6">
                 <!--begin::Label-->
                 <label class="col-lg-4 col-form-label fw-bold fs-6">
                     <span>{{ __('Residential Address') }}</span>

                     <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Namibian, permanent residence, foreigner') }}"></i>
                 </label>
                 <!--end::Label-->

                 <!--begin::Col-->
                 <div class="col-lg-8 fv-row">

                     <input type="text" name="residential_address_line_1" class="form-control form-control-lg form-control-solid mb-2" placeholder="Residential Address Line 1" data-label="Residential Address Line 1" value="{{ old('residential_address_line_1', $info->residential_address_line_1 ?? '') }}" />
                     <input type="text" name="residential_address_line_2" class="form-control form-control-lg form-control-solid mb-2" placeholder="Residential Address Line 2" data-label="Residential Address Line 2" value="{{ old('residential_address_line_2', $info->residential_address_line_2 ?? '') }}" />
                     <input type="text" name="residential_address_line_3" class="form-control form-control-lg form-control-solid" placeholder="Residential Address Line 3" data-label="Residential Address Line 3" value="{{ old('residential_address_line_3', $info->residential_address_line_3 ?? '') }}" />
                 </div>
                 <!--end::Col-->
             </div>
             <!--end::Input group-->

         </div>
         <!--end::Card body-->

     </div>
     <!--end::Content-->
 </div>