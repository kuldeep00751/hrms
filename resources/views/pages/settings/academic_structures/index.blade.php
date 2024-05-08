<x-base-layout>
    <div class="col-md-12 mx-auto">

        <div class="card">

            <div class="card-header">

                <div class="pull-left">
                    <a href="/system/settings" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                </div>

            </div>

            @if(count($qualifications) == 0)
            <div class="card-body text-center">
                <h4>No Modules Qualification combination Available.</h4>
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
                                <th>Qualification Name</th>
                                <th>Qualification Code</th>
                                <th>Qualification Level</th>
                                <th>No. of years</th>
                                <th>NQF level</th>
                                <th>Credits</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($qualifications as $qualification)
                            <tr>
                                <td>{{ $qualification->qualification_name }}</td>
                                <td>{{ $qualification->qualification_code }}</td>
                                <td>{{ optional($qualification->qualificationType)->application_type }}</td>
                                <td>{{ optional($qualification->numberOfYears)->year_level }}</td>
                                <td>{{ optional($qualification->nqfLevel)->nqf_level }}</td>
                                <td>{{ $qualification->qualification_credits }}</td>

                                <td>
                                    <a href="{{ route('academic_structures.academic_structure.edit', $qualification->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Curriculum</a>
                                    <a href="{{ route('qualifications.qualification.show', $qualification->id ) }}" class="btn btn-sm btn-light btn-active-light-primary" title="Show Qualification">
                                        Show
                                    </a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card-footer">
                {!! $qualifications->render() !!}
            </div>

            @endif

        </div>
    </div>
</x-base-layout>