<!--begin::Charts Widget 1-->
<div class="card mb-1">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <!--begin::Title-->

        <div class="card-title m-0">
            <h5 class="fw-bolder m-0">{{ __('Guardian Information') }}</h5>
        </div>
        <!--end::Title-->
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body p-9">
            @foreach($info->nextOfKin as $index => $nextOfKin)
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">{{ __('Name') }} </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $nextOfKin->nok_full_names }} ({{ optional($nextOfKin->relationship)->relationship }})</span>
                </div>
            </div>
            <!--end::Col-->
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">{{ __('Contact') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $nextOfKin->nok_contact_number }}</span>
                </div>
                <!--end::Col-->

                <!-- <div class="col-lg-2">
                        <button type="button" class="btn btn-light-danger btn-delete-next-of-kin"> <i class="fa-solid fa-trash"></i> Delete </button>
                    </div> -->

            </div>
            <!--end::Col-->
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">{{ __('ID Number') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $nextOfKin->nok_id_number }}</span>
                </div>
                <!--end::Col-->

            </div>
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">{{ __('Location and Address') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $nextOfKin->nok_address_line1 }}</span>
                </div>
                <!--end::Col-->

            </div>
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">{{ __('Closest Town') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $nextOfKin->nok_town }}</span>
                </div>
                <!--end::Col-->



            </div>
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">{{ __('Suburb / Village Name') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $nextOfKin->nok_suburb }}</span>
                </div>
                <!--end::Col-->


            </div>
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">{{ __('Country') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $nextOfKin->country->name }}</span>

                </div>
                <!--end::Col-->

            </div>
            <div class="separator separator-dashed mx-5 my-5"></div>
            @endforeach
    </div>
    <!--end::Body-->
</div>
<!--end::Charts Widget 1-->