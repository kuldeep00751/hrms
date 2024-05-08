<x-base-layout>
    <div class="col-md-12">

        <div class="card">
            <div class="card">

                <div class="card-header">

                    <div class="pull-left">
                        <a href="/system/settings#assessments" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                    </div>

                    <div class="pull-right" role="group">
                        <a href="{{ route('exam_paper_mark_criterias.exam_paper_mark_criteria.create') }}" class="btn btn-sm btn-primary" title="Create Exam Paper Grading Scale">
                            <i class="fa-solid fa-plus"></i> Add New
                        </a>
                        <a href="{{route('exam_paper_mark_criterias.exam_paper_mark_criteria.copyForm')}}" class="btn btn-sm btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="fa-solid fa-copy"></i>
                            Copy Exam Grading Scale
                        </a>
                    </div>

                </div>

                @if(count($examPaperMarkCriterias) == 0)
                <div class="card-body text-center">
                    <h4>No Exam paper grading scale defined.</h4>
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
                                    <th>Module Name</th>
                                    <th>Module Code</th>
                                    <th class="text-center">Academic Year</th>
                                    <th>Exam Type</th>
                                    <th>Paper Name</th>
                                    <th>Mark Range</th>
                                    <th>Result</th>
                                    <th class="text-center">Pass/Fail</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($examPaperMarkCriterias as $examPaperMarkCriteria)
                                <tr>
                                    <td>{{ $examPaperMarkCriteria->module->module_name }}</td>
                                    <td>{{ $examPaperMarkCriteria->module->module_code }}</td>
                                    <td class="text-center">{{ $examPaperMarkCriteria->academicYear->name }}</td>
                                    <td>{{ optional($examPaperMarkCriteria->assessmentType)->assessment_type }}</td>
                                    <td>{{ $examPaperMarkCriteria->examPaper->paper_name }}</td>
                                    <td>{{ $examPaperMarkCriteria->range_from }} - {{ $examPaperMarkCriteria->range_to }}</td>
                                    <td>{{ $examPaperMarkCriteria->assessmentResultCode->result_code }} - {{ $examPaperMarkCriteria->assessmentResultCode->result_code_description }}</td>
                                    <td class="text-center">{{ $examPaperMarkCriteria->assessmentResultCode->pass_fail }} </td>
                                    <td>
                                       
                                        <a href="{{ route('exam_paper_mark_criterias.exam_paper_mark_criteria.edit', $examPaperMarkCriteria->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="panel-footer">
                    {!! $examPaperMarkCriterias->render() !!}
                </div>

                @endif

            </div>
        </div>
</x-base-layout>