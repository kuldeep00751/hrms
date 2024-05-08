<!--begin::Basic info-->
<div class="card {{ $class }}">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('Previous Qualifications') }}</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <!--begin::Card body-->
    <div class="card-body border-top p-9">
        <div class="alert alert-info">
            <p>You may skip this section if you do not have previous qualifiations.</p>
            <ul>
                <li>Please give your full education history with the qualifications awarded.</li>
                <li>You must provide proof (certified copies) of all qualifications with your application.</li>
            </ul>
        </div>
        <div id="previous-qualification-container">
            @forelse($info->previousQualification as $index => $previousQualification)
            <div class="p-5 mb-5 border-dashed">
                <div class="row mb-3">
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Level') }}</label>
                    <div class="col-lg-4 fv-row">
                        <select name="level_id[]" aria-label="{{ __('Qualification Level') }}" data-placeholder="{{ __('Select your previous qualification level...') }}" class="form-select form-select-solid form-select-lg fw-bold" data-label="Qualification Level" required>
                            <option value="" style="display: none;" disabled selected>Select Level</option>
                            @foreach ($applicationTypes as $key => $value)
                            @if($info)
                            <option value="{{ $key }}" {{ old('level_id', optional($previousQualification)->level_id) == $key ? 'selected' : '' }}>
                                @else
                            <option value="{{ $key }}" {{ old('level_id', optional($info)->previousQualification) ? 'selected' : '' }}>
                                @endif
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
                        <input type="text" name="student_number[]" class="form-control form-control-lg form-control-solid" placeholder="Your student number at this institution" value="{{ optional($previousQualification)->student_number }}" />
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
                        <input type="text" name="institution[]" class="form-control form-control-lg form-control-solid" placeholder="Name of instition / university attended" value="{{ optional($previousQualification)->institution }}" data-label="Institution / University Name" required />
                    </div>
                    <!--end::Col-->

                </div>
                <div class="row mb-3">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Qualification name') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="qualification_name[]" class="form-control form-control-lg form-control-solid" placeholder="Name of qualification obtained" value="{{ optional($previousQualification)->qualification_name }}" data-label="Qualification Name" required />
                    </div>
                    <!--end::Col-->


                </div>
                <div class="row mb-3">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Has this qualification been awarded (Yes/No)') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <select name="awarded_yn[]" aria-label="{{ __('Select award status') }}" data-placeholder="{{ __('Select award status...') }}" data-control="select2" class="form-select form-select-solid form-select-lg fw-bold" data-label="Awarded Yes/No" required>
                            <option value="" style="display: none;" disabled selected>Select qualification award status</option>
                            <option value="0" {{ optional($previousQualification)->awarded_yn == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ optional($previousQualification)->awarded_yn == 1 ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Attended from date') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="from_date[]" class="form-control form-control-lg form-control-solid" data-inputmask="'mask': '9999-99'" placeholder="When did you start studying this qualification" value="{{ optional($previousQualification)->from_date }}" data-label="Attended From Date" required />
                    </div>
                    <!--end::Col-->

                </div>
                <div class="row mb-3">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Attended To date') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="to_date[]" class="form-control form-control-lg form-control-solid" data-inputmask="'mask': '9999-99'" placeholder="When did you stop with this qualification" value="{{ optional($previousQualification)->to_date }}" />
                    </div>
                    <!--end::Col-->

                </div>
                <div class="row mb-3">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Upload previous qualification document (PDF only)') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="file" name="previous_qualification_document[]" accept=".pdf" class="form-control form-control-lg form-control-solid" placeholder="When did you stop with this qualification" value="{{ optional($previousQualification)->to_date }}" />
                        @if($previousQualification->document_path)
                        <p class="text-info"> You have uploaded a document for this qualification. if you wish to update it please click select a new document. </p>
                        @else
                        <p class="text-danger">
                            You have not yet uploaded a document for this qualification, please use the field above to select a new document
                        </p>
                        @endif
                    </div>
                    <!--end::Col-->


                </div>

                <div class="separator separator-dashed mx-5 my-5"></div>
                <div class="col-lg-2 p-3">
                    <button type="button" data-id="{{ optional($previousQualification)->id }}" class="btn btn-sm btn-light-danger btn-delete-previous-qualification"> <i class="fa-solid fa-trash"></i> Delete </button>
                </div>
            </div>
            @empty
            <p>
                No previous qualifications has been recorded. To add new, please click on the button below.
            </p>
            @endforelse
        </div>
        <div class="row">
            <div class="col-lg-4">
                <button type="button" id="btn-add-previous-qualification" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Add Previous Qualification </button>
            </div>
        </div>
    </div>
    <!--end::Card body-->
</div>
<!--end::Basic info-->