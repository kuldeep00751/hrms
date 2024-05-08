<x-base-layout>
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <a href="{{ route('academic_processes.academic_process.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Academic Process Types</a>
                </div>
                <div class="pull-right">
                    <a href="{{ route('academic_processes.academic_process.create', $academicProcessType->id) }}" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                </div>
            </div>

            @if(count($academicProcesses) == 0)
            <div class="card-body text-center">
                <h6>No Academic Processes Available.</h6>
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

                <div class="table-responsive">

                    <table class="table table-row-dashed">
                        <thead>
                            <tr class="text-start text-gray-800 fw-bold text-uppercase">
                                <th>Process Name</th>
                                <th>Academic Year</th>
                                <th>Academic In take</th>
                                <th>Start Date</th>
                                <th>End Date</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($academicProcesses as $academicProcess)
                            <tr>
                                <td>{{ $academicProcess->process_name }}</td>
                                <td>{{ optional($academicProcess->academicYear)->name }}</td>
                                <td>{{ $academicProcess->academicIntake->name }}</td>
                                <td>{{ date('d M Y', strtotime($academicProcess->start_date)) }}</td>
                                <td>{{ date('d M Y', strtotime($academicProcess->end_date)) }}</td>

                                <td>
                                    <a href="{{ route('academic_processes.academic_process.edit', $academicProcess->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            @endif
        </div>
    </div>
</x-base-layout>