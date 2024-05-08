<!--begin::Basic info-->
<div class="card {{ $class }}">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('Secondary School Information') }}</h3>
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
                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Last School Attended') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-12 fv-row">
                            <input type="text" name="last_school_attended" class="form-control form-control-lg form-control-solid" placeholder="Enter your last school attended here" value="{{ old('last_school_attended', $info->last_school_attended ?? '') }}" data-label="Last school attended" required />
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
                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Education System') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-12 fv-row">

                            <select name="education_system_id" aria-label="{{ __('Select your education system') }}" data-placeholder="{{ __('Select your education system...') }}" class="form-select form-select-solid form-select-lg fw-bold" data-label="Education System" required>
                                <option value="">{{ __('Select your education system...') }}</option>
                                @foreach($educationSystems as $key => $value)
                                <option value="{{ $key }}" {{ $key === old('education_system_id', $info->education_system_id ?? '') ? 'selected' :'' }}>{{ $value }}</option>
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
                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Highest Grade') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-12 fv-row">
                            <input type="number" name="highest_grade" class="form-control form-control-lg form-control-solid" placeholder="Enter your highest grade passed" value="{{ old('highest_grade', $info->highest_grade ?? '') }}" data-label="Highest Grade Passed" required />
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
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span class="required">{{ __('Year Completed (YYYY-MM)') }}</span>

                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="The year you finished your secondary school"></i>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" id="year_completed" name="year_completed" data-inputmask="'mask': '9999-99'" class="form-control form-control-lg form-control-solid" placeholder="Enter the year you completed (Format: YYYY-MM)" value="{{ old('year_completed', $info->year_completed ?? '') }}" data-label="Year Completed" required />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label fw-bold fs-6">
                    <span class="required">{{ __('School Subjects') }}</span>

                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Please enter all your subjects below') }}"></i>
                </label>
                <!--end::Label-->
            </div>
            <!--begin::Input group-->
            <div class="row mb-6">
                <div class="col-lg-12">
                    <div class="table-responsive">

                        <table class="table table-row-dashed">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Subject</th>
                                    <th>Level</th>
                                    <th class="text-center">Final Result</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="school-subjects-tbl-body">
                                @forelse($userSchoolSubjects as $schoolSubject)

                                <tr>
                                    <td>
                                        <select name="school_subject_id[]" aria-label="{{ __('Select your subject') }}" data-placeholder="{{ __('Select your subject...') }}" class="form-select form-select-solid fw-bold" data-label="Subject Name" required>
                                            <option value="">{{ __('Select your subject...') }}</option>
                                            @foreach($schoolSubjects as $key => $value)
                                            <option value="{{ $key }}" {{ $schoolSubject->school_subject_id == $key ? 'selected' : '' }}> {{ $value }} </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="matric_type[]" aria-label="{{ __('Select your level') }}" data-placeholder="{{ __('Select your level...') }}" class="form-select form-select-solid fw-bold matric_types" data-label="Matric Type" required>
                                            <option value="">{{ __('Select your level...') }}</option>
                                            @foreach($matricTypes as $key => $value)
                                            <option value="{{ $key }}" {{ $key === $schoolSubject->matric_type ? 'selected' :'' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <select name="final_term_result[]" aria-label="{{ __('Select your symbol') }}" data-placeholder="{{ __('Select your symbol...') }}" class="form-select form-select-solid fw-bold final_term_results" data-label="Final Term Result" required>
                                            <option value="">{{ __('Select your symbol...') }}</option>
                                            @foreach($gradingScale->where('matric_type', $schoolSubject->matric_type) as $scale)
                                            <option value="{{ $scale->grade }}" data-points="{{ $scale->points }}" {{ ($scale->grade == $schoolSubject->final_term_result) ? 'selected' :'' }}>{{ $scale->grade }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" class="final_term_points" name="final_term_points[]" value="{{ $schoolSubject->final_term_points }}" />
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-light-danger btn-delete-subject" data-id="{{ $schoolSubject->id }}"> <i class="fa-solid fa-trash"></i> Delete </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td>
                                        <select name="school_subject_id[]" aria-label="{{ __('Select your subject') }}" data-placeholder="{{ __('Select your subject...') }}" class="form-select form-select-solid fw-bold" data-label="Subject Name" required>
                                            <option value="">{{ __('Select your subject...') }}</option>
                                            @foreach($schoolSubjects as $key => $value)
                                            <option value="{{ $key }}" {{ $key === old('school_subject_id', $info->school_subject_id ?? '') ? 'selected' :'' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="matric_type[]" aria-label="{{ __('Select your level') }}" data-placeholder="{{ __('Select your level...') }}" class="form-select form-select-solid fw-bold matric_types" data-label="Matric Type" required>
                                            <option value="">{{ __('Select your level...') }}</option>
                                            @foreach($matricTypes as $key => $value)
                                            <option value="{{ $key }}" {{ $key === old('matric_type', $info->matric_type ?? '') ? 'selected' :'' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <select name="final_term_result[]" aria-label="{{ __('Select your symbol') }}" data-placeholder="{{ __('Select your symbol...') }}" class="form-select form-select-solid fw-bold final_term_results" data-label="Final Term Result" required>
                                            <option value="">{{ __('Select your symbol...') }}</option>

                                        </select>
                                        <input type="hidden" class="final_term_points" name="final_term_points[]" />
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                @endforelse

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-center"><span class="fw-bold"><strong>Total Points</strong></span></td>

                                    <td class="text-center fw-bold">
                                        <span class="fw-bold" id="final_term_total_points">
                                            {{ $userSchoolSubjects->sum('final_term_points') }}
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <div class="row">
                <div class="col-lg-4">
                    <button type="button" id="btn-add-school-subject" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Add School Subject </button>
                </div>
            </div>

        </div>
        <!--end::Card body-->


    </div>
    <!--end::Content-->
</div>
<!--end::Basic info-->