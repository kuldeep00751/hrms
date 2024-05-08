<table class="table table-row-dashed table-rounded border">
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered" style="width:250px;">{{ __('Last School Attended') }}</th>
        <td>{{ $application->userInfo->last_school_attended }}</td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Education System') }}</th>
        <td>{{ $application->userInfo->educationSystem->system_name }} </td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Highest Grade') }}</th>
        <td>{{ $application->userInfo->highest_grade }}</td>
    </tr>

    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Year of Completion') }}</th>
        <td>{{ $application->userInfo->year_completed }} </td>
    </tr>
</table>

<table class="table table-row-dashed table-bordered border table-rounded">
    <thead>
        <tr class="text-start fw-bold text-uppercase bg-secondary p-5">
            <th>Subject</th>
            <th>Level</th>
            <th class="text-center">Mid-term Result</th>
            <th class="text-center">Final Result</th>
        </tr>
    </thead>
    <tbody>
        @forelse($application->userInfo->schoolSubjects as $schoolSubject)
        <tr>
            <td style="width: 30%;">
                {{ $schoolSubject->subject->subject_name}}
            </td>
            <td style="width: 20%;">
                {{ $schoolSubject->matric_type}}
            </td>
            <td style="width: 20%;" class="text-center">
                {{ $schoolSubject->mid_term_result}} ({{ $schoolSubject->mid_term_points}})
            </td>
            <td style="width: 20%;" class="text-center">
                {{ $schoolSubject->final_term_result}} ({{ $schoolSubject->final_term_points}})
            </td>
        </tr>
        @empty
        <div class="alert alert-info">
            Matric subjects not found
        </div>
        @endforelse

    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" class="text-center"><span class="fw-bold"><strong>Total Points</strong></span></td>
            <td class="text-center fw-bold">
                <span class="fw-bold" id="mid_term_total_points">
                    {{ $application->userInfo->schoolSubjects->sum('mid_term_points') }}
                </span>
            </td>
            <td class="text-center fw-bold">
                <span class="fw-bold" id="final_term_total_points">
                    {{ $application->userInfo->schoolSubjects->sum('final_term_points') }}
                </span>
            </td>
        </tr>
    </tfoot>
</table>