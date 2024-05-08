<!--begin::Basic info-->
<div class="card {{ $class }}">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('Health Questionnaire') }}</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="nok_information" class="collapse show">
        <!--begin::Card body-->
        <div class="card-body border-top p-9">
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Do you suffer from any chronic illness? (YES / NO)') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-4 fv-row">
                    <select name="chronic_illness_yn" aria-label="{{ __('Select') }}" data-placeholder="{{ __('Select...') }}" class="form-select form-select-solid form-select-lg fw-bold">
                        <option value="" style="display: none;" disabled selected>Select</option>
                        <option value="0" {{ optional($info->healthQuestionnaire)->chronic_illness_yn == 0 ? 'selected' : ''}}>No</option>
                        <option value="1" {{ optional($info->healthQuestionnaire)->chronic_illness_yn == 1 ? 'selected' : ''}}>Yes</option>
                    </select>
                </div>
            </div>
            <!--end::Col-->
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('If yes, specify:') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <textarea name="chronic_illness_description" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Please indicate all the chronic illnesses that you suffer from.')}}">{{ optional($info->healthQuestionnaire)->chronic_illness_description }}</textarea>
                </div>
                <!--end::Col-->

            </div>
            <!--end::Col-->
            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Do you have any disability? (YES / NO)') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-4 fv-row">
                    <select name="disability_yn" aria-label="{{ __('Select') }}" data-placeholder="{{ __('Select...') }}" class="form-select form-select-solid form-select-lg fw-bold">
                        <option value="" style="display: none;" disabled selected>Select</option>
                        <option value="0" {{ optional($info->healthQuestionnaire)->disability_yn == 0 ? 'selected' : ''}}>No</option>
                        <option value="1" {{ optional($info->healthQuestionnaire)->disability_yn == 1 ? 'selected' : ''}}>Yes</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('If yes, specify:') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <textarea name="disability_description" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Please describe any disabilities you have. Also indicate the kind of assistance you will need while studying with us.')}}">{{ optional($info->healthQuestionnaire)->disability_description }}</textarea>
                </div>
                <!--end::Col-->

            </div>

        </div>
        <!--end::Card body-->
    </div>
    <!--end::Content-->
</div>
<!--end::Basic info-->