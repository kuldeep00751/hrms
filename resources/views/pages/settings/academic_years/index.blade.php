<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">

            <div class="card-header">

                <div class="pull-left">
                    <a href="/system/settings" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                </div>
                <div class="pull-right">
                    <a href="{{ route('academic_years.academic_year.create') }}" class="btn btn-sm btn-primary" title="Create New Academic Intake">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                </div>

            </div>

            @if(count($academicYears) == 0)
            <div class="card-body text-center">
                <h6>No Academic Years Available.</h6>
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
                                <th>Name</th>
                                <th>From date</th>
                                <th>To date</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($academicYears as $academicYear)
                            <tr>
                                <td>{{ $academicYear->name }}</td>
                                <td>{{ $academicYear->start }}</td>
                                <td>{{ $academicYear->end }}</td>
                                <td>
                                    <a href="{{ route('academic_years.academic_year.edit', $academicYear->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                {!! $academicYears->render() !!}
            </div>

            @endif

        </div>
    </div>
</x-base-layout>