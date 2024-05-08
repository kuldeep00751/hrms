<div class="card {{ $class }}">
    <!--begin::Header-->
    <div class="card-header border-0">
        <h3 class="card-title fw-bolder text-dark">Registration per Qualification</h3>


    </div>
    <!--end::Header-->

    <!--begin::Body-->
    @php
    $registrations = $registrationsByQualification['registrationsPerCampus'];
    @endphp
    <div class="card-body pt-2 overflow-auto">
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <thead>
                <tr class="fw-bolder text-muted">
                    <th>Qualification Name</th>
                    @foreach($registrations->unique('campus_name') as $campus)
                    <th>{{ $campus->campus_name }}</th>
                    @endforeach
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registrations->groupBy('qualification_name') as $qualificationName => $qualificationData)
                <tr>
                    <td>{{ $qualificationName }}</td>
                    @php
                    $totalQualificationCount = 0;
                    @endphp
                    @foreach($registrations->unique('campus_name') as $campus)
                    @php
                    $count = $qualificationData->where('campus_name', $campus->campus_name)->first()->count ?? 0;
                    $totalQualificationCount += $count;
                    @endphp
                    <td class="text-center">{{ $count }}</td>
                    @endforeach
                    <th class="text-center"><strong>{{ $totalQualificationCount }}</strong></th>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-muted">
                        <i>Enrolment data not found.</i>
                    </td>
                </tr>
                @endforelse

            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6"></th>
                </tr>
                <tr>
                    <td>Total</td>
                    @foreach($registrations->unique('campus_name') as $campus)
                    @php
                    $totalCampusCount = $registrations->where('campus_name', $campus->campus_name)->sum('count');
                    @endphp
                    <td class="text-center"><strong>{{ $totalCampusCount }}</strong></td>
                    @endforeach
                    <th class="text-center"><strong>{{ $registrations->sum('count') }}</strong></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>