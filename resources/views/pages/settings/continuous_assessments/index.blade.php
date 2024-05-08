<x-base-layout>
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <a href="/system/settings#assessments" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                </div>
                <div class="pull-right">
                    <a href="{{ route('continuous_assessments.continuous_assessment.create') }}" class="btn btn-sm btn-primary" title="Create New Assessment Weight">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                </div>
            </div>

            @if(count($continuousAssessments) == 0)
            <div class="card-body text-center">
                <h4>No Continuous assessments Available.</h4>
            </div>
            @else
            <div class="card-body pt-6">
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
                                <th>Module Name</th>
                                <th>Module Code</th>
                                <th>Academic Year</th>
                                <th>Assessment Mark Types</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($modules as $module)
                            @php
                            $assessmentMarkTypes = $continuousAssessments->where('module_id', $module->module_id)
                            ->where('academic_year_id', $module->academic_year_id);

                            @endphp
                            <tr>
                                <td>
                                    @if(count($assessmentMarkTypes))
                                    {{ $assessmentMarkTypes->first()->module->module_name }}
                                    @endif
                                </td>
                                <td>
                                    @if(count($assessmentMarkTypes))
                                    {{ $assessmentMarkTypes->first()->module->module_code }}
                                    @endif
                                </td>
                                <td>
                                    @if(count($assessmentMarkTypes))
                                    {{ $assessmentMarkTypes->first()->academicYear->name }}
                                    @endif
                                </td>
                                <td>
                                    @foreach($assessmentMarkTypes as $assessmentMarkType)
                                    {{ $assessmentMarkType->markType->mark_type }} (<i>Weight: {{ $assessmentMarkType->weight }} </i>) <br />
                                    @endforeach
                                </td>
                                <td>
                                    @if(count($assessmentMarkTypes))
                                    <a href="{{ route('continuous_assessments.continuous_assessment.edit', $assessmentMarkTypes->first()->module_id.'_'.$assessmentMarkTypes->first()->academic_year_id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
                                    @endif
                                    <!--end::Menu-->
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