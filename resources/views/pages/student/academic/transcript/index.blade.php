<x-base-layout>
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-bottom border-gray-200">
            <!--begin::Title-->
            <div class="card-title">
                <h3 class="fw-bold m-0">Academic Transcript</h3>
            </div>
            <!--end::Title-->
        </div>
        <!--end::Card header-->
        <div class="card-body">
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-dashed" id="kt_datatable_example">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bold text-uppercase">
                            <td>Academic Year</td>
                            <td>In take</td>
                            <td>Qualification</td>
                            <td>Qualification Code</td>
                            <td>Study Mode</td>
                            <td>Year Level</td>
                            <td>Status</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <!--begin::Table row-->
                        @foreach($studentRegistration as $registration)
                        <tr>
                            <td>{{ $registration->academicYear->name }}</td>
                            <td>{{ $registration->academicIntake->name}}</td>
                            <td>{{ $registration->qualification->qualification_name }}</td>
                            <td>{{ $registration->qualification->qualification_code }}</td>
                            <td>{{ $registration->studyMode->study_mode }}</td>
                            <td>{{ $registration->yearLevel->year_level }}</td>
                            <td>{{ $registration->registrationStatus->status }}</td>
                            <td>
                                <a href="{{ route('academic.transcript.view', $registration->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">View</a>
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