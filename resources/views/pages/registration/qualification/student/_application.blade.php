<!--begin::Basic info-->
<div class="card {{ $class }}">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('Application') }}</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="school_leaving_info" class="collapse show">
        <!--begin::Card body-->
        <div class="card-body border-top p-9">
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Academic In-take') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-12 fv-row">

                            <select name="academic_intake_id" aria-label="{{ __('Select your intake') }}" data-placeholder="{{ __('Select your intake...') }}" class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Select your intake...') }}</option>
                                @foreach($academicIntake as $key => $value)
                                
                                @endforeach
                            </select>
                        </div>
                        <!--end::Col-->

                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Qualification') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-12 fv-row">

                            <select name="qualification_id" aria-label="{{ __('Select your qualification') }}" data-placeholder="{{ __('Select your qualification...') }}" data-control="select2" class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Select your qualification...') }}</option>
                                @foreach($qualifications as $qualification)
                                <option value="{{ $qualification->id }}" {{ $qualification->id === optional($info->qualification)->qualification_id ? 'selected' :'' }}>{{ $qualification->qualification_name }} ({{ $qualification->qualificationType->application_type}})</option>
                                @endforeach
                            </select>
                        </div>
                        <!--end::Col-->

                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Campus') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-12 fv-row">

                            <select name="campus_id" aria-label="{{ __('Select your campus') }}" data-placeholder="{{ __('Select your campus...') }}" class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Select your campus...') }}</option>
                                @foreach($campus as $key => $value)
                                <option value="{{ $key }}" {{ $key === old('campus_id', optional($info->application)->campus_id ?? '') ? 'selected' :'' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Study Mode') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-12 fv-row">

                            <select name="study_mode_id" aria-label="{{ __('Select your study mode') }}" data-placeholder="{{ __('Select your study mode...') }}" class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Select your study mode...') }}</option>
                                @foreach($studyModes as $key => $value)
                                <option value="{{ $key }}" {{ $key === old('study_mode_id', optional($info->application)->study_mode_id ?? '') ? 'selected' :'' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

        </div>
        <!--end::Card body-->

        <!--begin::Actions-->
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button type="reset" class="btn btn-white btn-active-light-primary me-2">{{ __('Discard') }}</button>

            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                @include('partials.general._button-indicator', ['label' => __('Save Changes')])
            </button>
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Content-->
</div>
<!--end::Basic info-->