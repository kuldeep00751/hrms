<!--begin::List Widget 5-->
<div class="card {{ $class }}">
    <!--begin::Header-->
    <div class="card-header align-items-center border-0 mt-4">
        <h3 class="card-title align-items-start flex-column">
            <span class="fw-bolder mb-2 text-dark">Enrolments Per Subject</span>
            <span class="text-muted fw-bold fs-7">{{ $subjectStatistics['totalModules']}} Modules</span>
        </h3>

       
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body pt-0">
        <div class="row overflow-auto" style="height: 590px;">


            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                <thead>
                    <tr class="fw-bolder text-muted">
                        <th>Subject</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subjectStatistics['enrolmentPerSubject'] as $subjectEnrolment)

                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="d-flex justify-content-start flex-column">
                                    <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{ $subjectEnrolment->module_name }}</a>

                                    <span class="text-muted fw-bold text-muted d-block fs-7">{{ $subjectEnrolment->module_code }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="text-end">
                            <div class="d-flex flex-column w-100 me-2">
                                <div class="d-flex flex-stack mb-2">
                                    <span class="text-muted me-2 fs-7 fw-bold">
                                        @php
                                        $percentage = number_format(($subjectEnrolment->count / $subjectStatistics['enrolmentPerSubject']->sum('count')) * 100);
                                        @endphp

                                        {{ $subjectEnrolment->count}} ({{ $percentage }}%)
                                    </span>
                                </div>
                                <div class="progress h-6px w-100">
                                    <div class="progress-bar bg-{{ App\Core\Data::getProgressBarColor($percentage) }}" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <p class="text-muted">
                        <i>Subject enrolment information not available.</i>
                    </p>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!--end: Card Body-->
</div>
<!--end: List Widget 5-->