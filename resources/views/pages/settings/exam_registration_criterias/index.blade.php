<x-base-layout>
    <div class="col-md-12">

        <div class="card">

            <div class="card-header">

                <div class="pull-left">
                    <a href="/system/settings#assessments" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                </div>

                <div class="pull-right">
                    <a href="{{ route('exam_registration_criterias.exam_registration_criteria.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                </div>

            </div>

            @if(count($examRegistrationCriterias) == 0)
            <div class="card-body text-center">
                <h4>No Criterias defined.</h4>
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
                                <th>Academic Year</th>
                                <th>Assessment Type</th>
                                <th>Required Assessment Mark Type</th>
                                <th>Required Assessment Type</th>
                                <th>Minimum Mark</th>
                                <th>Maximum Mark</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($examRegistrationCriterias as $examRegistrationCriteria)
                            <tr>
                                <td>{{ $examRegistrationCriteria->academicYear->name }}</td>
                                <td>{{ $examRegistrationCriteria->assessmentType->assessment_type }}</td>
                                <td>{{ $examRegistrationCriteria->required_assessment_mark }}</td>
                                <td>{{ $examRegistrationCriteria->requiredAssessmentType->assessment_type }}</td>
                                <td>{{ $examRegistrationCriteria->minimum_mark }}</td>
                                <td>{{ $examRegistrationCriteria->maximum_mark }}</td>

                                <td>
                                    <a href="{{ route('exam_registration_criterias.exam_registration_criteria.edit', $examRegistrationCriteria->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            @endif

        </div>
</x-base-layout>