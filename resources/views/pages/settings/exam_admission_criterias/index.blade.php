<x-base-layout>
    <div class="col-md-12">

        <div class="card">

            <div class="card-header">

                <div class="pull-left">
                    <a href="/system/settings#assessments" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                </div>

                <div class="pull-right">
                    <a href="{{ route('exam_admission_criterias.exam_admission_criteria.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                </div>

            </div>

            @if(count($examAdmissionCriterias) == 0)
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
                    <table class="table table-row-dashed" id="kt_datatable_example">
                        <thead>
                            <tr class="text-start text-gray-800 fw-bold text-uppercase">
                                <th>Module Name</th>
                                <th>Academic Year</th>
                                <th>Assessment Type</th>
                                <th>Minimum Attendance</th>
                                <th>Minimum CA for Exam Admission</th>
                                <th>CA Weight to Final Mark</th>
                                <th>Exam Weight to Final Mark</th>
                                <th>Subminimum Result Code</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($examAdmissionCriterias as $examAdmissionCriteria)
                            <tr>
                                <td>{{ $examAdmissionCriteria->module->module_name }}</td>
                                <td>{{ $examAdmissionCriteria->academicYear->name }}</td>
                                <td>{{ $examAdmissionCriteria->assessmentType->assessment_type ?? '' }}</td>
                                <td>{{ $examAdmissionCriteria->minimum_attendance }}</td>
                                <td>{{ $examAdmissionCriteria->minimum_ca_mark }}</td>
                                <td>{{ $examAdmissionCriteria->ca_weight }}</td>
                                <td>{{ $examAdmissionCriteria->exam_weight }}</td>
                                <td>{{ $examAdmissionCriteria->assessmentResultCode->result_code }}-{{ $examAdmissionCriteria->assessmentResultCode->result_code_description }}</td>

                                <td>
                                    <a href="{{ route('exam_admission_criterias.exam_admission_criteria.edit', $examAdmissionCriteria->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
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