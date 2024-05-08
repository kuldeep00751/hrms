<x-base-layout>
    <div class="card">
        <div class="card-header">
            <div class="pull-left">
                <a href="{{ route('proof_of_registration.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Back</a>
            </div>
            <div class="pull-right">
                <a href="{{ route('proof_of_registration.print', $studentRegistration->id) }}" class="btn btn-sm btn-primary" target="_blank">
                    <i class="fa-solid fa-print"></i> Printable Version
                </a>
            </div>
        </div>
        <div class="card-body">
            <h3 class="fw-bold mb-5">Proof of Registration</h3>
            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('Student Name') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $studentRegistration->userInfo->first_names }} {{ $studentRegistration->userInfo->surname }} </span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('Student Number') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $studentRegistration->userInfo->student_number }} </span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('ID Number') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $studentRegistration->userInfo->id_number }} </span>
                </div>
                <!--end::Col-->
            </div>
            <p class="mb-5 mt-5 fw-bold">
                This is to certify that the student has been registered as follows:
            </p>
            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('Qualification') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $studentRegistration->qualification->qualification_name }} ({{ $studentRegistration->qualification->qualification_code }})</span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('Year Level') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $studentRegistration->yearLevel->year_level }}</span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('Academic Year') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $studentRegistration->academicYear->name }}</span>
                </div>
                <!--end::Col-->
            </div>

            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('Academic Intake') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $studentRegistration->academicIntake->name }}</span>
                </div>
                <!--end::Col-->
            </div>

            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('Study Mode') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $studentRegistration->studyMode->study_mode }}</span>
                </div>
                <!--end::Col-->
            </div>

            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('Campus') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $studentRegistration->campus->name }}</span>
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
                            <td>Exemption Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <!--begin::Table row-->
                        @forelse($moduleRegistration as $registration)
                        <tr>
                            <td>{{ $registration->module->module_name }}</td>
                            <td>{{ $registration->module->module_code}}</td>
                            <td>{{ $registration->academicIntake->name }}</td>
                            <td>{{ $registration->studyMode->study_mode }}</td>
                            <td>{{ $registration->studyPeriod->study_period }}</td>
                            <td>{{ ($registration->is_exempted == 1) ? "Exempted" : "Not Exempted" }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-info">
                                    No modules found.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                        <!--end::Table row-->
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
    </div>
</x-base-layout>