<!--begin::Charts Widget 1-->
<div class="card mb-1">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <!--begin::Title-->

        <div class="card-title m-0">
            <h5 class="fw-bolder m-0">{{ __('Previous Qualifications') }}</h5>
        </div>
        <!--end::Title-->
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body p-9">

        <div id="previous-qualification-container">
            @if(isset($info->previousQualification))
            @forelse($info->previousQualification as $index => $previousQualification)
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">{{ __('Level') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $previousQualification->level->application_type }} </span>
                </div>
            </div>
            <!--end::Col-->
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">{{ __('Student Number') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $previousQualification->student_number }} </span>
                </div>
                <!--end::Col-->


            </div>
            <!--end::Col-->
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">{{ __('Institution / University name') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $previousQualification->institution }} </span>
                </div>
                <!--end::Col-->

            </div>
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">{{ __('Qualification name') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $previousQualification->qualification_name }} </span>
                </div>
                <!--end::Col-->


            </div>
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">{{ __('Has this qualification been awarded (Yes/No)') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $previousQualification->awarded_yn == 1 ? 'Yes' : 'No' }} </span>
                </div>
            </div>
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">{{ __('Period') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $previousQualification->from_date }} - {{$previousQualification->to_date }} </span>
                </div>
                <!--end::Col-->

            </div>

            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">{{ __('Uploaded document') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    @if($previousQualification->document_path)
                    <span class="fw-bolder fs-6 text-dark">
                        <a href="/previous-qualifications/download/{{$previousQualification->id}}/{{ $info->name }}" class="btn btn-sm btn-light btn-active-light-primary">
                            <i class="fa-solid fa-download"></i> Download
                        </a>
                    </span>
                    @else
                    <p class="text-danger">
                        You have not yet uploaded a document for this qualification. To upload a document, click Edit Profile above and scroll to the previous qualifications section.
                    </p>
                    @endif
                </div>
                <!--end::Col-->


            </div>

            <div class="separator separator-dashed mx-5 my-5"></div>
            @empty
            <p class="alert alert-info">
                You do not have any previous qualifications
            </p>
            @endforelse
            @endif
        </div>
    </div>
</div>
<!--end::Body-->