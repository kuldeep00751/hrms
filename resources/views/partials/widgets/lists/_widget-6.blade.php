<!--begin::List Widget 6-->
<div class="card {{ $class }}">
    <!--begin::Header-->
    <div class="card-header border-0">
        <h3 class="card-title fw-bolder text-dark">Admissions vs. Registration</h3>
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body pt-0">
        <!--begin::Item-->
        <div class="d-flex align-items-center bg-light-warning rounded p-5 mb-5">
            <!--begin::Icon-->
            <span class="svg-icon svg-icon-warning me-5">
                {!! theme()->getSvgIcon("icons/duotune/abstract/abs027.svg", "svg-icon-1"); !!}
            </span>
            <!--end::Icon-->

            <!--begin::Title-->
            <div class="flex-grow-1 me-2">
                <a href="#" class="fw-bolder text-gray-800 text-hover-warning fs-6">Applications</a>

                <span class="text-muted fw-bold d-block">All students that have applied</span>
            </div>
            <!--end::Title-->

            <!--begin::Lable-->
            <span class="fw-bolder text-warning py-1">{{ $registrationVsAdmission['applicationsCount'] ?? 0 }}</span>
            <!--end::Lable-->
        </div>
        <!--begin::Item-->
        <div class="d-flex align-items-center bg-light-success rounded p-5 mb-5">
            <!--begin::Icon-->
            <span class="svg-icon svg-icon-success me-5">
                {!! theme()->getSvgIcon("icons/duotune/abstract/abs027.svg", "svg-icon-1"); !!}
            </span>
            <!--end::Icon-->

            <!--begin::Title-->
            <div class="flex-grow-1 me-2">
                <a href="#" class="fw-bolder text-gray-800 text-hover-primary fs-6">Admitted Students</a>

                <span class="text-muted fw-bold d-block">All students with full admission status</span>
            </div>
            <!--end::Title-->

            <!--begin::Lable-->
            <span class="fw-bolder text-success py-1">{{ $registrationVsAdmission['admissionsCount'] ?? 0 }}</span>
            <!--end::Lable-->
        </div>
        <!--end::Item-->

        <!--begin::Item-->
        <div class="d-flex align-items-center bg-light-primary rounded p-5 mb-5">
            <!--begin::Icon-->
            <span class="svg-icon svg-icon-primary me-5">
                {!! theme()->getSvgIcon("icons/duotune/abstract/abs027.svg", "svg-icon-1"); !!}
            </span>
            <!--end::Icon-->

            <!--begin::Title-->
            <div class="flex-grow-1 me-2">
                <a href="#" class="fw-bolder text-gray-800 text-hover-primary fs-6">Registered Students</a>

                <span class="text-muted fw-bold d-block">All students that have been registered</span>
            </div>
            <!--end::Title-->

            <!--begin::Lable-->
            <span class="fw-bolder text-primary py-1">{{ $registrationVsAdmission['registrationCount'] ?? 0 }}</span>
            <!--end::Lable-->
        </div>
        <!--end::Item-->
        <div class="over">
            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                <thead>
                    <tr class="fw-bolder text-muted">
                        <th colspan="2">Total Applications per Campus</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($registrationVsAdmission['applicationsByCampus'] as $key => $campus)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="d-flex justify-content-start flex-column">
                                    <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">
                                        {{ $key }}
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td class="text-end">
                            <div class="d-flex flex-column w-100 me-2">
                                <div class="d-flex flex-stack mb-2">
                                    <span class="text-muted me-2 fs-7 fw-bold">
                                        {{ $registrationVsAdmission['applicationsByCampus'][$key] }}
                                    </span>
                                </div>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <p class="text-muted">
                        <i>Enrolment information not available.</i>
                    </p>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-right">
                            <strong>Total</strong>
                        </th>
                        <th>
                            <span class="text-muted me-2 fs-7 fw-bold">{{ collect($registrationVsAdmission['applicationsByCampus'])->sum() }}</span>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!--end::Body-->
</div>
<!--end::List Widget 6-->