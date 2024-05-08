<div class="card">
     <!--begin::Card header-->
     <div class="card-header border-0">
         <!--begin::Card title-->
         <div class="card-title m-0">
             <h3 class="fw-bolder m-0">{{ __('Employee Residential Address') }}</h3>
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
                    <span>{{ __('Residential Address') }}</span>
                </label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="residential_address_line_1" class="form-control form-control-lg form-control-solid mb-2" placeholder="Residential Address Line 1" value="{{ old('residential_address_line_1', $employee->residential_address_line_1 ?? '') }}" data-label="Residential Address Line 1" />
                    <input type="text" name="residential_address_line_2" class="form-control form-control-lg form-control-solid mb-2" placeholder="Residential Address Line 2" value="{{ old('residential_address_line_2', $employee->residential_address_line_2 ?? '') }}" data-label="Residential Address Line 2" />
                    <input type="text" name="residential_address_line_3" class="form-control form-control-lg form-control-solid" placeholder="Residential Address Line 3" value="{{ old('residential_address_line_3', $employee->residential_address_line_3 ?? '') }}" data-label="Residential Address Line 3" />
                </div>
                <!--end::Col-->
            </div>

            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span>{{ __('Suburb or Town / City') }}</span>
                </label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">

                    <input type="text" name="suburb" class="form-control form-control-lg form-control-solid mb-2" placeholder="Suburb or Town / City" value="{{ old('suburb', $employee->suburb ?? '') }}" data-label="Suburb or Town / City" />
                </div>
                <!--end::Col-->
            </div>


            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span>{{ __('Region') }}</span>
                </label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">

                    <select name="regions" aria-label="{{ __('Select regions') }}" data-placeholder="{{ __('Select regions...') }}" class="form-select form-select-solid form-select-lg fw-bold" data-label="countries">
                        <option value="">{{ __('Select regions...') }}</option>
                        
                    @if(isset($employee->regions))
                        @foreach($regions as $key => $value)
                        <option value="{{ $key }}" {{ $key === old('regions', (int)$employee->regions ?? '') ? 'selected' :'' }}>{{ $value }}</option>
                        @endforeach
                    @else
                        @foreach($regions as $key => $value)
                        <option value="{{ $key }}" {{ ($value == "Khomas") ? 'selected' :'' }}>{{ $value }}</option>
                        @endforeach
                    @endif
                    </select>
                </div>
                <!--end::Col-->
            </div>


            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span>{{ __('Country') }}</span>
                </label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">

                <select name="countries_id" aria-label="{{ __('Select countries') }}" data-placeholder="{{ __('Select countries...') }}" class="form-select form-select-solid form-select-lg fw-bold" data-label="countries">
                    <option value="">{{ __('Select countries...') }}</option>
                    @if(isset($employee->countries_id))
                        @foreach($countries as $key => $value)
                        <option value="{{ $key }}" {{ $key === old('countries_id', (int)$employee->countries_id ?? '') ? 'selected' :'' }}>{{ $value }}</option>
                        @endforeach
                    @else
                        @foreach($countries as $key => $value)
                        <option value="{{ $key }}" {{ ($value == "Namibia") ? 'selected' :'' }}>{{ $value }}</option>
                        @endforeach
                    @endif
                </select>
                </div>
                <!--end::Col-->
            </div>
         </div>
         <!--end::Card body-->

     </div>
     <!--end::Content-->
 </div>
 