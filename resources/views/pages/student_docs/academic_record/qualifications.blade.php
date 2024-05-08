<x-base-layout>
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-bottom border-gray-200">
            <div class="pull-left">
                <a href="{{ route('academic_record.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Back</a>
            </div>
            <!--begin::Title-->
            <div class="pull-right">
                <h3 class="fw-bold m-0">Academic Record</h3>
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
                            <td>Qualification</td>
                            <td>Qualification Code</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <!--begin::Table row-->
                        @foreach($studentRegistration as $registration)
                        <tr>
                            <td>{{ $registration->qualification->qualification_name }}</td>
                            <td>{{ $registration->qualification->qualification_code }}</td>
                            <td>
                                <a href="{{ route('academic_record.show', [$registration->qualification_id, $userInfo->id] ) }}" class="btn btn-sm btn-light btn-active-light-primary">View</a>
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