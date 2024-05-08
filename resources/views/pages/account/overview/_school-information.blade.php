<!--begin::Charts Widget 1-->
<div class="card mb-1">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <div class="card-title m-0">
            <h5 class="fw-bolder m-0">{{ __('Secondary School Information') }}</h5>
        </div>
        <!--end::Title-->
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body p-9">
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Last School Attended') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                <span class="fw-bolder fs-6 text-dark">{{ $info->last_school_attended }} </span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Education System') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                <span class="fw-bolder fs-6 text-dark">{{ optional($info->educationSystem)->system_name }} </span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Highest Grade') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                <span class="fw-bolder fs-6 text-dark">{{ $info->highest_grade }} </span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-10">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Year Completed') }}</label>
            <!--end::Label-->

            <div class="col-lg-8 fv-row">
                <span class="fw-bolder fs-6 text-dark">{{ $info->year_completed }} </span>
            </div>
        </div>
        <!--end::Input group-->

        <div class="row mb-6">
            <div class="col-lg-12">
                <div class="table-responsive">

                    <table class="table table-row-dashed table-bordered border table-rounded p-5">
                        <thead>
                            <tr class="text-start fw-bold text-uppercas ">
                                <th>Subject</th>
                                <th>Level</th>
                                <th class="text-center">Mid-term Result</th>
                                <th class="text-center">Final Result</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($info->schoolSubjects as $schoolSubject)
                            <tr>
                                <td style="width: 30%;">
                                    {{ $schoolSubject->subject->subject_name}}
                                </td>
                                <td style="width: 20%;">
                                    {{ $schoolSubject->matric_type}}
                                </td>
                                <td style="width: 20%;" class="text-center">
                                    {{ $schoolSubject->mid_term_result}} ({{ $schoolSubject->mid_term_points}})
                                </td>
                                <td style="width: 20%;" class="text-center">
                                    {{ $schoolSubject->final_term_result}} ({{ $schoolSubject->final_term_points}})
                                </td>
                            </tr>
                            @empty
                            <div class="alert alert-info">
                                Matric subjects not found
                            </div>
                            @endforelse

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-center"><span class="fw-bold"><strong>Total Points</strong></span></td>
                                <td class="text-center fw-bold">
                                    <span class="fw-bold" id="mid_term_total_points">
                                        {{ $info->schoolSubjects->sum('mid_term_points') }}
                                    </span>
                                </td>
                                <td class="text-center fw-bold">
                                    <span class="fw-bold" id="final_term_total_points">
                                        {{ $info->schoolSubjects->sum('final_term_points') }}
                                    </span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
            <!--end::Col-->
        </div>

    </div>
    <!--end::Body-->
</div>
<!--end::Charts Widget 1-->