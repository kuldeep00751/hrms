<x-base-layout>
    <div class="col-md-8 mx-auto">

        <div class="card">

            <div class="card-header">

                <div class="pull-left">
                    <a href="/system/settings" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                </div>

                <div class="pull-right">
                    <a href="{{ route('matric_types.matric_type.create') }}" class="btn btn-sm btn-primary" title="Create New Matric Type">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                </div>

            </div>

            @if(count($matricTypes) == 0)
            <div class="card-body text-center">
                <h4>No Matric Types Available.</h4>
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
                            <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                <th>System</th>
                                <th>Matric Type</th>
                                <th>Grade</th>
                                <th>Points</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($matricTypes as $matricType)
                            <tr>
                                <td>{{ $matricType->educationSystem->system_name }}</td>
                                <td>{{ $matricType->matric_type }}</td>
                                <td>{{ $matricType->grade }}</td>
                                <td>{{ $matricType->points }}</td>

                                <td>
                                    <a href="{{ route('matric_types.matric_type.edit', $matricType->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card-footer">
                {!! $matricTypes->render() !!}
            </div>

            @endif

        </div>
    </div>
</x-base-layout>