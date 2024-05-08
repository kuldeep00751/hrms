<!--begin::Charts Widget 1-->
<div class="card mb-1">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <!--begin::Title-->
        <div class="card-title m-0">
            <h5 class="fw-bolder m-0">{{ __('Employment') }}</h5>
        </div>
        <!--end::Title-->
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body p-9">
        @if($info->employment)
        <div class="row mb-3">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Company Name') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                <span class="fw-bolder fs-6 text-dark">{{ optional($info->employment)->company_name }} </span>
            </div>
        </div>
        <!--end::Col-->
        <div class="row mb-3">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Position') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                <span class="fw-bolder fs-6 text-dark">{{ optional($info->employment)->position }} </span>
            </div>
            <!--end::Col-->


        </div>
        <!--end::Col-->
        <div class="row mb-3">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Department') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                <span class="fw-bolder fs-6 text-dark">{{ optional($info->employment)->department }} </span>
            </div>
            <!--end::Col-->

        </div>
        <div class="row mb-3">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Company Address') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                <span class="fw-bolder fs-6 text-dark">{{ optional($info->employment)->company_address }} </span>
            </div>
            <!--end::Col-->


        </div>
        <div class="row mb-3">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Work Contact Number') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                <span class="fw-bolder fs-6 text-dark">{{ optional($info->employment)->work_contact_number }} </span>
            </div>
        </div>
        <div class="row mb-3">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Work Email') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                <span class="fw-bolder fs-6 text-dark">{{ optional($info->employment)->work_email }} </span>
            </div>
            <!--end::Col-->

        </div>


        @else
        <p class="alert alert-info">
            No employment information found
        </p>
        @endif

    </div>
    <!--end::Body-->
</div>
<!--end::Charts Widget 1-->