<x-base-layout>
    <div class="card">
        @php
        $info = $subjectDetails->first();
        @endphp
        <div class="card-header">
            <div class="pull-left">
                <a href="{{ route('academic_record.user_info.qualifications', $registrations->first()->user_info_id) }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Back</a>
            </div>
            @if(count($subjectDetails))
            <div class="pull-right">
                <a href="{{ route('academic_record.print', [$registrations->first()->qualification_id, $registrations->first()->user_info_id]) }}" class="btn btn-sm btn-primary" target="_blank">
                    <i class="fa-solid fa-print"></i> Printable Version
                </a>
            </div>
            @endif
        </div>
        <div class="card-body">
            <h3 class="fw-bold mb-5">Academic Record</h3>
            @if(count($subjectDetails))
            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('Student Name') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{$info->title}} {{ $info->first_names }} {{ $info->surname }} </span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('Student Number') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $info->student_number }} </span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('ID Number') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $info->id_number }} </span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('Qualification') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $info->qualification_name }} ({{ $info->qualification_code }})</span>
                </div>
                <!--end::Col-->
            </div>

            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('Academic Intake') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $info->academic_intake }}</span>
                </div>
                <!--end::Col-->
            </div>

            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('Study Mode') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $info->study_mode }}</span>
                </div>
                <!--end::Col-->
            </div>

            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('Campus') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $info->campus_name }}</span>
                </div>
                <!--end::Col-->
            </div>

            <div class="table-responsive mt-10">
                <div class="separator separator-dashed mx-5 my-5"></div>
                <!--begin::Table-->
                <table class="table" style="font-size: 12px;">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bold text-uppercase">
                            <td>Module Name</td>
                            <td>Module Code</td>
                            <td>Academic Intake</td>
                            <td>Study Mode</td>
                            <td>Study Period</td>
                            <td>Exam Type</td>
                            <td>Final Mark</td>
                            <td>Result</td>
                            <td>Result Description</td>
                        </tr>
                    </thead>
                    <tbody>
                        <!--begin::Table rows-->
                        @php
                        $currentYear = null;
                        $promotionStatus = null;
                        @endphp
                        @foreach($subjectDetails as $subjectDetail)
                        @if (!isset($currentYear) || $currentYear != $subjectDetail->academic_year)
                        <!-- Display the subjects for the current year -->
                        @if ($currentYear !== null)
                        <tr>
                            <td colspan="9"><strong>Annual Result for {{ $currentYear }}: {{ $promotionStatus }}</strong></td>
                        </tr>
                        @endif
                        <!-- Update current year and promotion status -->
                        @php
                        $currentYear = $subjectDetail->academic_year;
                        $promotionStatus = $subjectDetail->promotion_result;
                        @endphp
                        <tr>
                            <td colspan="9"><strong>Academic Year: {{ $subjectDetail->academic_year }}</strong></td>
                        </tr>
                        @endif
                        <tr>
                            <td>{{ $subjectDetail->module_name }}</td>
                            <td>{{ $subjectDetail->module_code}}</td>
                            <td>{{ $subjectDetail->academic_intake }}</td>
                            <td>{{ $subjectDetail->study_mode }}</td>
                            <td>{{ $subjectDetail->study_period }}</td>
                            <td>{{ $subjectDetail->assessment_type }}</td>
                            <td>{{ $subjectDetail->final_mark }}</td>
                            <td>
                                {{ $subjectDetail->result_code }}
                            </td>
                            <td>
                                {{ $subjectDetail->result_code_description }}
                            </td>
                        </tr>
                        @endforeach
                        <!-- Display promotion status for the last year -->
                        <tr>
                            <td colspan="9"><strong>Annual Result for {{ $subjectDetail->academic_year }}: {{ $promotionStatus }}</strong></td>
                        </tr>
                        <!--end::Table rows-->
                        <!--end::Table row-->
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
            @else
            <div class="alert alert-danger">
                Subject information not found.
            </div>
            @endif
        </div>
    </div>
</x-base-layout>