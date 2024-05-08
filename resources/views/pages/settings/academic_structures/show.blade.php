<x-base-layout>
    <div class="col-md-6 mx-auto">

        <div class="mb-7 card">
            <div class="card-header">

                <div class="pull-left">
                    <a href="/modules" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> List</a>
                </div>

            </div>

            <div class="card-body p-9">
                <!--begin::Row-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">{{ __('Module Name') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-dark">{{ $module->module_name }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">{{ __('Module Code') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold fs-6">{{ $module->module_code }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">{{ __('NQF Level') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 d-flex align-items-center">
                        <span class="fw-bolder fs-6 me-2">{{ optional($module->nqfLevel)->nqf_level }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">
                        {{ __('Credits') }}
                    </label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-dark">
                            {{ $module->module_credits }}
                        </span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">{{ __('Module Level') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-dark">
                            {{ optional($module->moduleLevel)->application_type }}
                        </span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

            </div>
        </div>

        <div class="mb-7 card">
            <div class="card-header">

                <span class="pull-left">
                    <h4 class="mt-5 mb-5">Module Study Modes</h4>
                </span>
            </div>

            <div class="card-body p-9">
                @if(count($module->studyModes) == 0)
                <div class="card-body text-center">
                    <h6>No Study Modes Available.</h6>
                </div>
                @else
                <div class="card-body">

                    <table class="table table-row-dashed">
                        <tbody>
                            @foreach($module->studyModes as $studyMode)
                            <tr>
                                <td>{{ $studyMode->studyMode->study_mode }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                @endif
            </div>
        </div>

        <div class="mb-7 card">
            <div class="card-header">

                <span class="pull-left">
                    <h4 class="mt-5 mb-5">Module Study Periods</h4>
                </span>
            </div>

            <div class="card-body p-9">
                @if(count($module->studyPeriods) == 0)
                <div class="card-body text-center">
                    <h6>No Study Periods Available.</h6>
                </div>
                @else
                <div class="card-body">

                    <table class="table table-row-dashed">
                        <tbody>
                            @foreach($module->studyPeriods as $studyPeriod)
                            <tr>
                                <td>{{ $studyPeriod->studyPeriod->study_period }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                @endif
            </div>
        </div>
    </div>

</x-base-layout>