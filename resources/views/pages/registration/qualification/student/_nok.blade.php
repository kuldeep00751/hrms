 <div class="p-5 mb-5 border-dashed">
     <div class="row mb-3">
         <!--begin::Label-->
         <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Relationship') }}</label>
         <!--end::Label-->

         <!--begin::Col-->
         <div class="col-lg-4 fv-row">

             <select name="nok_relationship_id[]" aria-label="{{ __('Relationship') }}" data-placeholder="{{ __('Select your next of kin relationship...') }}" data-control="select2" class="form-select form-select-solid form-select-lg fw-bold">
                 <option value="" style="display: none;" disabled selected>Select Next of kin Relationship</option>
                 @foreach ($nextOfKinRelationships as $key => $nextOfKinRelationship)
                 <option value="{{ $key }}">
                     {{ $nextOfKinRelationship }}
                 </option>
                 @endforeach
             </select>
         </div>
     </div>

     <!--end::Col-->
     <div class="row mb-3">
         <!--begin::Label-->
         <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Full name and contact') }}</label>
         <!--end::Label-->

         <!--begin::Col-->
         <div class="col-lg-4 fv-row">
             <input type="text" name="nok_full_names[]" class="form-control form-control-lg form-control-solid" placeholder="Next of Kin Full names" />
         </div>
         <!--end::Col-->
         <!--begin::Col-->
         <div class="col-lg-4 fv-row">
             <input type="text" name="nok_contact_number[]" class="form-control form-control-lg form-control-solid" placeholder="Next of Kin Contact Number" />
         </div>
         <!--end::Col-->
         <!-- <div class="col-lg-2">
                        <button type="button" class="btn btn-light-danger btn-delete-next-of-kin"> <i class="fa-solid fa-trash"></i> Delete </button>
                    </div> -->

     </div>
     <!--end::Col-->
     <div class="row mb-3">
         <!--begin::Label-->
         <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('ID Number') }}</label>
         <!--end::Label-->

         <!--begin::Col-->
         <div class="col-lg-8 fv-row">
             <input type="text" name="nok_id_number[]" class="form-control form-control-lg form-control-solid" placeholder="Next of Kin ID number" />
         </div>
         <!--end::Col-->

         <!-- <div class="col-lg-2">
                        <button type="button" class="btn btn-light-danger btn-delete-next-of-kin"> <i class="fa-solid fa-trash"></i> Delete </button>
                    </div> -->

     </div>

     <div class="row mb-3">
         <!--begin::Label-->
         <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Location and Address') }}</label>
         <!--end::Label-->

         <!--begin::Col-->
         <div class="col-lg-8 fv-row">
             <input type="text" name="nok_address_line1[]" class="form-control form-control-lg form-control-solid" placeholder="ERF Number / Street Name / House" />
         </div>
         <!--end::Col-->

         <!-- <div class="col-lg-2">
                        <button type="button" class="btn btn-light-danger btn-delete-next-of-kin"> <i class="fa-solid fa-trash"></i> Delete </button>
                    </div> -->

     </div>
     <div class="row mb-3">
         <!--begin::Label-->
         <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Closest Town') }}</label>
         <!--end::Label-->

         <!--begin::Col-->
         <div class="col-lg-8 fv-row">
             <input type="text" name="nok_town[]" class="form-control form-control-lg form-control-solid" placeholder="Next of Kin closest town" />
         </div>
         <!--end::Col-->

         <!-- <div class="col-lg-2">
                        <button type="button" class="btn btn-light-danger btn-delete-next-of-kin"> <i class="fa-solid fa-trash"></i> Delete </button>
                    </div> -->

     </div>
     <div class="row mb-3">
         <!--begin::Label-->
         <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Suburb / Village Name') }}</label>
         <!--end::Label-->

         <!--begin::Col-->
         <div class="col-lg-8 fv-row">
             <input type="text" name="nok_suburb[]" class="form-control form-control-lg form-control-solid" placeholder="Suburb / Village Name" />
         </div>
         <!--end::Col-->

         <!-- <div class="col-lg-2">
                        <button type="button" class="btn btn-light-danger btn-delete-next-of-kin"> <i class="fa-solid fa-trash"></i> Delete </button>
                    </div> -->

     </div>

     <div class="row mb-3">
         <!--begin::Label-->
         <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Country') }}</label>
         <!--end::Label-->

         <!--begin::Col-->
         <div class="col-lg-8 fv-row">
             <select name="nok_country_id[]" aria-label="{{ __('Country') }}" data-placeholder="{{ __('Select your next of kin country...') }}" data-control="select2" class="form-select form-select-solid form-select-lg fw-bold">
                 <option value="" style="display: none;" disabled selected>Select Next of kin country</option>
                 @foreach ($countries as $key => $value)
                 <option value="{{ $key }}">
                     {{ $value }}
                 </option>
                 @endforeach
             </select>
         </div>
         <!--end::Col-->

     </div>
     <div class="separator separator-dashed mx-5 my-5"></div>
     <div class="col-lg-2 p-3">
         <button type="button" class="btn btn-sm btn-light-danger btn-delete-next-of-kin"> <i class="fa-solid fa-trash"></i> Delete </button>
     </div>
 </div>