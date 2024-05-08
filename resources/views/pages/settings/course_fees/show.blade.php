<x-base-layout>
    <div class="col-md-6 mx-auto">

        <div class="mb-7 card">
            <div class="card-header">

                <div class="pull-left">
                    <a href="/qualifications" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> List</a>
                </div>

            </div>

            <div class="card-body p-9">
                <!--begin::Row-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">{{ __('Qualification Name') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-dark">{{ $qualification->qualification_name }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">{{ __('Qualification Code') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold fs-6">{{ $qualification->qualification_code }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">
                        {{ __('Number of Years') }}
                    </label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 d-flex align-items-center">
                        <span class="fw-bolder fs-6 me-2">{{ $qualification->numberOfYears->year_level }}</span>
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
                        <span class="fw-bolder fs-6 me-2">{{ optional($qualification->nqfLevel)->nqf_level }}</span>
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
                            {{ $qualification->qualification_credits }}
                        </span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">{{ __('Qualification Level') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-dark">
                            {{ optional($qualification->qualificationType)->application_type }}
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
                    <h4 class="mt-5 mb-5">Qualification Campuses</h4>
                </span>
            </div>

            <div class="card-body p-9">
                <table class="table table-row-dashed">
                    <thead>
                        <tr class="text-start text-gray-800 fw-bold text-uppercase">
                            <th>Name</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($qualification->campuses as $campus)
                        <tr>
                            <td>{{ $campus->campus->name }}</td>
                            <td>
                                {{ $campus->campus->address_line_1 }} <br>
                                {{ $campus->campus->address_line_2 }} <br>
                                {{ $campus->campus->address_line_3 }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mb-7 card">
            <div class="card-header">

                <span class="pull-left">
                    <h4 class="mt-5 mb-5">Qualification Study Modes</h4>
                </span>
            </div>

            <div class="card-body p-9">
                @if(count($qualification->studyModes) == 0)
                <div class="card-body text-center">
                    <h6>No Study Modes Available.</h6>
                </div>
                @else
                <div class="card-body">
                    @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <h6 class="text-success">
                            <i class="fa-solid fa-circle-check text-success"></i>
                            {!! session('success_message') !!}
                        </h6>
                    </div>
                    @endif

                    <table class="table table-row-dashed">
                        <tbody>
                            @foreach($qualification->studyModes as $studyMode)
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
    </div>

</x-base-layout>