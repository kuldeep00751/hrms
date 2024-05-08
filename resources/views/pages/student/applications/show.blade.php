<x-base-layout>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <a href="{{ route('application.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> My Applications</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="p-5 mb-5 rounded">
                        <h3 class="mb-5">Application Information</h3>
                        <table class="table table-row-dashed table-rounded border">
                            <tr>
                                <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Choice Number') }}</th>
                                <td>{{ $application->choice_number }}</td>
                            </tr>
                            <tr>
                                <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Academic Year') }}</th>
                                <td>{{ $application->academicYear->name }}</td>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Application Type') }}</th>
                                <td>{{ $application->applicationType->application_type }}</td>
                            </tr>

                            <tr>
                                <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('In take') }}</th>
                                <td>{{ $application->academicIntake->name }} </td>
                            </tr>
                            <tr>
                                <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Qualification') }}</th>
                                <td>{{ $application->qualification->qualification_name }} ({{ $application->qualification->qualification_code }})</td>
                            </tr>
                            <tr>
                                <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Campus') }}</th>
                                <td>{{ $application->campus->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Study Mode') }}</th>
                                <td>{{ $application->studyMode->study_mode }}</td>
                            </tr>
                            <tr>
                                <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Application Status') }}</th>
                                <td>{{ $application->application_status }}</td>
                            </tr>
                        </table>
                        <div class="separator separator-dashed mx-5 my-5"></div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            @if(count($application->applicationHistory) > 0)
            <div class="row">
                <h5 class="card-title mb-3"><strong>Application History</strong></h5>
                <div class="bg-white p-5">
                    <div class="timeline">
                        @foreach($application->applicationHistory as $index => $application_history)
                        <div class="timeline-item">
                            <!--begin::Timeline line-->
                            <div class="timeline-line w-40px"></div>
                            <!--end::Timeline line-->
                            <!--begin::Timeline icon-->
                            <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
                                <div class="symbol-label bg-light">
                                    <i class="fa-solid fa-{{$index + 1}}"></i>
                                </div>
                            </div>
                            <!--end::Timeline icon-->
                            <!--begin::Timeline content-->
                            <div class="timeline-content mb-10 mt-n1">
                                <!--begin::Timeline heading-->
                                <div class="pe-3 mb-5">
                                    <!--begin::Title-->
                                    <div class="fs-5 fw-semibold mb-2">Status changed to <mark>{{ $application_history->admissionStatus->status }}</mark>
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Description-->
                                    <div class="d-flex align-items-center mt-1 fs-6">
                                        <!--begin::Info-->
                                        <div class="text-muted me-2 fs-7">{{$application_history->created_at}} by</div>
                                        <!--end::Info-->
                                        <!--begin::User-->
                                        <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" aria-label="Nina Nilson" data-bs-original-title="Nina Nilson" data-kt-initialized="1">
                                            {{$application_history->user->first_name}} {{$application_history->user->last_name}}
                                        </div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Timeline heading-->
                                <!--begin::Timeline details-->
                                <div class="overflow-auto pb-5">
                                    <span><strong>Remarks: </strong></span><br>
                                    <i>{{$application_history->remark}}</i>
                                </div>
                                <!--end::Timeline details-->
                            </div>
                            <!--end::Timeline content-->
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-info">
                Application has not yet been processed.
            </div>
            @endif
        </div>
    </div>
</x-base-layout>