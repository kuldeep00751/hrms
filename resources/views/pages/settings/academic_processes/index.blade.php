<x-base-layout>
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <a href="/system/settings" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                </div>
            </div>

            @if(count($academicProcessTypes) == 0)
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

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($academicProcessTypes as $academicProcessType)
                            <tr>
                                <td>{{ $academicProcessType->process_type }}</td>
                                <td>
                                    <a href="{{ route('academic_processes.academic_process.show', $academicProcessType->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Show</a>
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