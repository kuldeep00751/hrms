<x-base-layout>
    <div class="card">
        @php
        $info = $subjectDetails->first();
        @endphp
        <div class="card-header">
            <div class="pull-left">
                <a href="{{ route('academic.transcript') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Back</a>
            </div>
            <div class="pull-right">
                <a href="{{ route('academic.transcript.print', $registration->id) }}" class="btn btn-sm btn-primary" target="_blank">
                    <i class="fa-solid fa-print"></i> Printable Version
                </a>
            </div>
        </div>
        <div class="card-body">
            <h3 class="fw-bold mb-5">Academic Transcript</h3>
            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('Student Name') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $info->first_names }} {{ $info->surname }} </span>
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
                <table class="table table-row-dashed" id="kt_datatable_example">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bold text-uppercase">
                            <td>Module Name</td>
                            <td>Module Code</td>
                            <td>Academic Intake</td>
                            <td>Study Mode</td>
                            <td>Study Period</td>
                            <td>Final Mark</td>
                            <td>Result</td>
                        </tr>
                    </thead>
                    <tbody>
                        <!--begin::Table row-->
                        @foreach($subjectDetails as $subjectDetail)
                        @if (!isset($currentYear) || $currentYear != $subjectDetail->academic_year)
                        <tr>
                            <td colspan="7"><strong>{{ $subjectDetail->academic_year }}</strong></td>
                        </tr>
                        @php
                        $currentYear = $subjectDetail->academic_year;
                        @endphp
                        @endif
                        <tr>
                            <td>{{ $subjectDetail->module_name }}</td>
                            <td>{{ $subjectDetail->module_code}}</td>
                            <td>{{ $subjectDetail->academic_intake }}</td>
                            <td>{{ $subjectDetail->study_mode }}</td>
                            <td>{{ $subjectDetail->study_period }}</td>
                            <td>
                                @if($suppress)
                                <i>Suppressed</i>
                                @else
                                {{ $subjectDetail->final_mark }}
                                @endif

                            </td>
                            <td>
                                @if($suppress)
                                <i>Suppressed</i>
                                @else
                                {{ $subjectDetail->result_code_description }}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        <!--end::Table row-->
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
    </div>
</x-base-layout>