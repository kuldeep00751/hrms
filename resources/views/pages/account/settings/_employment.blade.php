<!--begin::Basic info-->
<div class="card {{ $class }}">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('Employment') }}</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="nok_information" class="collapse show">
        <!--begin::Card body-->
        <div class="card-body border-top p-9">
            <div class="alert alert-info">
                <p>You may skip this section if you are not employed.</p>
            </div>
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Company name') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="company_name" class="form-control form-control-lg form-control-solid" placeholder="Company name" value="{{ optional($info->employment)->company_name }}" />
                </div>
            </div>
            <!--end::Col-->
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Position') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="position" class="form-control form-control-lg form-control-solid" placeholder="Position / Title" value="{{ optional($info->employment)->position }}" />
                </div>
                <!--end::Col-->


            </div>
            <!--end::Col-->
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Department') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="department" class="form-control form-control-lg form-control-solid" placeholder="Department" value="{{ optional($info->employment)->department }}" />
                </div>
                <!--end::Col-->

            </div>
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Company Address') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="company_address" class="form-control form-control-lg form-control-solid" placeholder="Company Address" value="{{ optional($info->employment)->company_address }}" />
                </div>
                <!--end::Col-->


            </div>
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Work contact number') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="work_contact_number" class="form-control form-control-lg form-control-solid" placeholder="Work contact number" value="{{ optional($info->employment)->work_contact_number }}" />
                </div>
            </div>
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Work Email Address') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="email" name="work_email" class="form-control form-control-lg form-control-solid" placeholder="Work email" value="{{ optional($info->employment)->work_email }}" />
                </div>
                <!--end::Col-->

            </div>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Content-->
</div>
<!--end::Basic info-->