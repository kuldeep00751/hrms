<!--begin::Charts Widget 1-->
<div class="card {{ $class ?? '' }}">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <!--begin::Title-->
        <div class="card-title m-0">
            <h5 class="fw-bolder m-0">{{ __('Health Questionnaire') }}</h5>
        </div>
        <!--end::Title-->
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body p-9">
        <div class="row mb-10">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Do you suffer from any chronic illness?') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                <span class="fw-bolder fs-6 text-dark">{{ optional($info->healthQuestionnaire)->chronic_illness_yn  == 0 ? 'No' : ''}}</span>
                @if(optional($info->healthQuestionnaire)->chronic_illness_yn)
                <span class="fw-bolder fs-6 text-dark">{{ optional($info->healthQuestionnaire)->chronic_illness_description }} </span>
                @endif
            </div>
        </div>
        <!--end::Col-->
        <div class="row mb-3">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Do you have any disability?') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                <span class="fw-bolder fs-6 text-dark">{{ optional($info->healthQuestionnaire)->disability_yn == 0 ? 'No' : ''}} </span>
                @if(optional($info->healthQuestionnaire)->disability_yn)
                <span class="fw-bolder fs-6 text-dark">{{ optional($info->healthQuestionnaire)->disability_description }} </span>
                @endif
            </div>
            <!--end::Col-->


        </div>
        <!--end::Col-->
    </div>
    <!--end::Body-->
</div>
<!--end::Charts Widget 1-->