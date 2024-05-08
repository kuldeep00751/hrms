<div class="p-5 mb-5 border-dashed">
    <div class="row mb-3">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Level') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
            <select name="level_id[]" aria-label="{{ __('Qualification Level') }}" data-placeholder="{{ __('Select your previous qualification level...') }}" class="form-select form-select-solid form-select-lg fw-bold">
                <option value="" style="display: none;" disabled selected>Select Previous qualification level </option>
                @foreach ($applicationTypes as $key => $value)
                <option value="{{ $key }}">
                    {{ $value }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <!--end::Col-->
    <div class="row mb-3">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Student Number') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
            <input type="text" name="student_number[]" class="form-control form-control-lg form-control-solid" placeholder="Your student number at this institution" />
        </div>
        <!--end::Col-->


    </div>
    <!--end::Col-->
    <div class="row mb-3">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Institution / University name') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
            <input type="text" name="institution[]" class="form-control form-control-lg form-control-solid" placeholder="Name of instition / university attended" />
        </div>
        <!--end::Col-->

        <!-- <div class="col-lg-2">
                        <button type="button" class="btn btn-light-danger btn-delete-next-of-kin"> <i class="fa-solid fa-trash"></i> Delete </button>
                    </div> -->

    </div>
    <div class="row mb-3">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Qualification name') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
            <input type="text" name="qualification_name[]" class="form-control form-control-lg form-control-solid" placeholder="Name of qualification obtained" />
        </div>
        <!--end::Col-->

        <!-- <div class="col-lg-2">
                        <button type="button" class="btn btn-light-danger btn-delete-next-of-kin"> <i class="fa-solid fa-trash"></i> Delete </button>
                    </div> -->

    </div>
    <div class="row mb-3">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Has this qualification been awarded (Yes/No)') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
            <select name="awarded_yn[]" aria-label="{{ __('Select award status') }}" data-placeholder="{{ __('Select award status...') }}" class="form-select form-select-solid form-select-lg fw-bold">
                <option value="" style="display: none;" disabled selected>Select qualification award status</option>
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Attended from date (YYYY-MM)') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
            <input type="text" name="from_date[]" class="form-control form-control-lg form-control-solid" data-inputmask="'mask': '9999-99'" placeholder="When did you start studying this qualification (YYYY-MM)" />
        </div>
        <!--end::Col-->

    </div>
    <div class="row mb-3">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Attended To date (YYYY-MM)') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
            <input type="text" name="to_date[]" class="form-control form-control-lg form-control-solid" data-inputmask="'mask': '9999-99'" placeholder="When did you stop with this qualification (YYYY-MM)" />
        </div>
        <!--end::Col-->

    </div>

    <div class="row mb-3">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Upload previous qualification document (PDF only)') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
            <input type="file" name="previous_qualification_document[]" accept=".pdf" class="form-control form-control-lg form-control-solid" placeholder="When did you stop with this qualification" />
        </div>
        <!--end::Col-->

    </div>

    <div class="separator separator-dashed mx-5 my-5"></div>
    <div class="col-lg-2 p-3">
        <button type="button" class="btn btn-sm btn-light-danger btn-delete-previous-qualification"> <i class="fa-solid fa-trash"></i> Delete </button>
    </div>
</div>