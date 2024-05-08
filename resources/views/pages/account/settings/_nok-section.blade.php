<!--begin::Basic info-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('Guardian / Next of Kin Information') }}</h3>
        </div>
        <!--end::Card title-->
    </div>
    <div class="card-body border-top p-9">
        <div id="next-of-kin-container">
            @forelse($info->nextOfKin as $index => $nextOfKin)
            <div class="p-5 mb-5 border-dashed">
                <div class="row mb-3">
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Relationship') }}</label>
                    <div class="col-lg-8 fv-row">
                        <select name="nok_relationship_id[]" aria-label="{{ __('Relationship') }}" data-placeholder="{{ __('Select your next of kin relationship...') }}" class="form-select form-select-solid form-select-lg fw-bold" data-label="Relationship" required>
                            <option value="" style="display: none;" disabled selected>Select Next of kin Relationship</option>
                            @foreach ($nextOfKinRelationships as $key => $nextOfKinRelationship)
                            @if($info)
                            <option value="{{ $key }}" {{ old('nok_relationship_id', $nextOfKin->nok_relationship_id) == $key ? 'selected' : '' }}>
                                @else
                            <option value="{{ $key }}" {{ old('nok_relationship_id', optional($info)->nextOfKin) ? 'selected' : '' }}>
                                @endif
                                {{ $nextOfKinRelationship }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!--end::Col-->
                <div class="row mb-3">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Full name') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="nok_full_names[]" class="form-control form-control-lg form-control-solid" placeholder="Next of Kin Full names" value="{{ $nextOfKin->nok_full_names }}" data-label="Next of Kin Full names" required />
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row mb-3">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Contact number') }}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="nok_contact_number[]" class="form-control form-control-lg form-control-solid" placeholder="Next of Kin Contact Number" value="{{ $nextOfKin->nok_contact_number }}" data-label="Next of Kin Contact Number" required />
                    </div>
                    <!--end::Col-->
                    <!-- <div class="col-lg-2">
                        <button type="button" class="btn btn-light-danger btn-delete-next-of-kin"> <i class="fa-solid fa-trash"></i> Delete </button>
                    </div> -->

                </div>
                <!--end::Col-->
                <div class="row mb-3">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('ID Number') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="nok_id_number[]" class="form-control form-control-lg form-control-solid" placeholder="Next of Kin ID number" value="{{ $nextOfKin->nok_id_number }}" />
                    </div>
                    <!--end::Col-->

                    <!-- <div class="col-lg-2">
                        <button type="button" class="btn btn-light-danger btn-delete-next-of-kin"> <i class="fa-solid fa-trash"></i> Delete </button>
                    </div> -->

                </div>
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Location and Address') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="nok_address_line1[]" class="form-control form-control-lg form-control-solid" placeholder="ERF Number / Street Name / House" value="{{ $nextOfKin->nok_address_line1 }}" />
                    </div>
                    <!--end::Col-->

                    <!-- <div class="col-lg-2">
                        <button type="button" class="btn btn-light-danger btn-delete-next-of-kin"> <i class="fa-solid fa-trash"></i> Delete </button>
                    </div> -->

                </div>
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Closest Town') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="nok_town[]" class="form-control form-control-lg form-control-solid" placeholder="Next of Kin closest town" value="{{ $nextOfKin->nok_town }}" />
                    </div>
                    <!--end::Col-->



                </div>
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Suburb / Village Name') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="nok_suburb[]" class="form-control form-control-lg form-control-solid" placeholder="Suburb / Village Name" value="{{ $nextOfKin->nok_suburb }}" />
                    </div>
                    <!--end::Col-->


                </div>
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Country') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <select name="nok_country_id[]" aria-label="{{ __('Country') }}" data-placeholder="{{ __('Select your next of kin country...') }}" data-control="select2" class="form-select form-select-solid form-select-lg fw-bold">
                            <option value="" style="display: none;" disabled selected>Select Next of kin country</option>
                            @foreach ($countries as $key => $value)
                            @if($info)
                            <option value="{{ $key }}" {{ old('nok_country_id', $nextOfKin->nok_country_id) == $key ? 'selected' : '' }}>
                                @else
                            <option value="{{ $key }}" {{ old('nok_country_id', optional($info)->nextOfKin) ? 'selected' : '' }}>
                                @endif
                                {{ $value }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <!--end::Col-->

                    <!-- <div class="col-lg-2">
                        <button type="button" class="btn btn-light-danger btn-delete-next-of-kin"> <i class="fa-solid fa-trash"></i> Delete </button>
                    </div> -->

                </div>
                @if($index > 0)
                <div class="separator separator-dashed mx-5 my-5"></div>
                <div class="col-lg-2 p-3">
                    <button type="button" data-id="{{ $nextOfKin->id }}" class="btn btn-sm btn-light-danger btn-delete-next-of-kin"> <i class="fa-solid fa-trash"></i> Delete </button>
                </div>
                @endif
            </div>
            @empty
            <div class="p-5 mb-5 border-dashed">
                <div class="row mb-3">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Relationship') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">

                        <select name="nok_relationship_id[]" aria-label="{{ __('Relationship') }}" data-placeholder="{{ __('Select your next of kin relationship...') }}" class="form-select form-select-solid form-select-lg fw-bold" data-label="Next of Kin Relationship"  required>
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
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Full name') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="nok_full_names[]" class="form-control form-control-lg form-control-solid" placeholder="Next of Kin Full names" data-label="Next of Kin Full names" required />
                    </div>
                    <!--end::Col-->

                </div>
                <div class="row mb-3">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Contact') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="nok_contact_number[]" class="form-control form-control-lg form-control-solid" placeholder="Next of Kin Contact Number" data-label="Next of Kin Contact Number" required />
                    </div>
                    <!--end::Col-->
                    <!-- <div class="col-lg-2">
                        <button type="button" class="btn btn-light-danger btn-delete-next-of-kin"> <i class="fa-solid fa-trash"></i> Delete </button>
                    </div> -->

                </div>
                <!--end::Col-->
                <div class="row mb-3">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('ID Number') }}</label>
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
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Location and Address') }}</label>
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
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Closest Town') }}</label>
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
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Suburb / Village Name') }}</label>
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
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Country') }}</label>
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
            </div>
            @endforelse
        </div>
        <div class="row">
            <div class="col-lg-4">
                <button type="button" id="btn-add-next-of-kin" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Add Next of Kin </button>
            </div>
        </div>
    </div>
    <!--end::Card body-->
</div>
<!--end::Basic info-->