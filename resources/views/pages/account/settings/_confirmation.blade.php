<!--begin::Basic info-->
<div class="card {{ $class }}">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('Confirm and Submit') }}</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="confirmation" class="collapse show">
        <!--begin::Card body-->
        <div class="card-body border-top p-9">
            <div class="alert alert-info">
                <strong>Declaration: </strong>
                <ol>
                    <li>I certify that all the information provided in this application is complete and accurate to the best of my knowledge and belief. </li>
                    <li>I understand that the institution retains the right to reject any application or rescind any admission offer if any part of the information provided is found to be false or incorrect, or if an offer was made in error.</li>
                    <li>I acknowledge that, if accepted at the institution, I will be subject to the disciplinary authority of the institution's authorities. I commit to familiarize myself with and abide by the rules and regulations of the institution.</li>
                </ol>
            </div>

        </div>
        <!--begin::Actions-->
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <!-- <button type="reset" class="btn btn-white btn-active-light-primary me-2">{{ __('Discard') }}</button> -->

            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                @include('partials.general._button-indicator', ['label' => __('Save Changes')])
            </button>
        </div>
        <!--end::Actions-->
        <!--end::Card body-->
    </div>
    <!--end::Content-->
</div>
<!--end::Basic info-->