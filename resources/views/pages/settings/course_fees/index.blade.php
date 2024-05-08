<x-base-layout>
    <div class="col-md-12">

        <div class="card">
            <div class="card">

                <div class="card-header">

                    <div class="pull-left">
                        <a href="/system/settings#finance" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                    </div>

                    <div class="pull-right" role="group">
                        <a href="{{ route('courseFees.courseFee.create') }}" class="btn btn-sm btn-primary" title="Create New Course Fee">
                            <i class="fa-solid fa-plus"></i> Add New
                        </a>
                        <a href="{{route('courseFees.courseFee.copyForm')}}" class="btn btn-sm btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="fa-solid fa-copy"></i>
                            Copy Course Fees
                        </a>
                    </div>

                </div>

                @if(count($courseFees) == 0)
                <div class="card-body text-center">
                    <h4>No Course Fees Available.</h4>
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

                        <table class="table table-row-dashed" id="kt_datatable_example">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Qualification Name</th>
                                    <th>Qualification Code</th>
                                    <th>Year Level</th>
                                    <th>Academic Year</th>
                                    <th>Student Type</th>
                                    <th>Amount (N$)</th>
                                    <th>Academic Process</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courseFees as $courseFee)
                                <tr>
                                    <td>{{ $courseFee->qualification->qualification_name }}</td>
                                    <td>{{ $courseFee->qualification->qualification_code }}</td>
                                    <td>{{ optional($courseFee->yearLevel)->year_level }}</td>
                                    <td>{{ $courseFee->academicYear->name }}</td>
                                    <td>{{ $courseFee->studentType->student_type }}</td>
                                    <td>{{ number_format($courseFee->amount,2,".",",") }}</td>
                                    <td>{{ $courseFee->academic_process }}</td>

                                    <td>
                                        <a href="{{ route('courseFees.courseFee.edit', $courseFee->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
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
    </div>
</x-base-layout>