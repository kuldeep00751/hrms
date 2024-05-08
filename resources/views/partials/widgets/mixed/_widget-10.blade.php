@php
$chartColor = $chartColor ?? 'primary';
$chartHeight = $chartHeight ?? '175px';
@endphp

<!--begin::Mixed Widget 10-->
<div class="card {{ $class }}">
    <!--begin::Body-->
    <div class="card-body p-0 d-flex justify-content-between flex-column overflow-hidden">


        <!--begin::Chart-->
        <div class="card-body pt-1 overflow-auto">
            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                <thead>
                    <tr class="fw-bolder text-muted">
                        <th></th>
                        <th>Female</th>
                        <th>Male</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $females = 0;
                    $males = 0;
                    @endphp
                    @forelse ($enrolmentCampusStatistics as $key => $campus)
                    
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="d-flex justify-content-start flex-column">
                                    <strong>{{ $key }}</strong>
                                </div>
                            </div>
                        </td>

                        <td class="text-end">
                            <div class="d-flex flex-column w-100 me-2">
                                <div class="d-flex flex-stack mb-2">
                                    <span class="text-muted me-2 fs-7 fw-bold">
                                        @php
                                        $females += $enrolmentCampusStatistics[$key]["Female"] ?? 0;
                                        $males += $enrolmentCampusStatistics[$key]["Male"] ?? 0;
                                        @endphp
                                        {{ $f = $enrolmentCampusStatistics[$key]["Female"] ?? 0 }}

                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="text-end">
                            <div class="d-flex flex-column w-100 me-2">
                                <div class="d-flex flex-stack mb-2">
                                    <span class="text-muted me-2 fs-7 fw-bold">
                                        {{ $m = $enrolmentCampusStatistics[$key]["Male"] ?? 0 }}
                                    </span>
                                </div>
                            </div>
                        </td>

                        <td class="text-end">
                            <div class="d-flex flex-column w-100 me-2">
                                <div class="d-flex flex-stack mb-2">
                                    <span class="text-muted me-2 fs-7 fw-bold">
                                        {{ $f + $m }}
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
                            <span class="text-muted me-2 fs-7 fw-bold">
                                {{ $females }}
                            </span>
                        </th>
                        <th>
                            <span class="text-muted me-2 fs-7 fw-bold">
                                {{ $males }}
                            </span>
                        </th>
                        <th>
                            <span class="text-muted me-2 fs-7 fw-bold">
                                {{ $females + $males }}
                            </span>
                        </th>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!--end::Chart-->
    </div>
</div>
<!--end::Mixed Widget 10-->