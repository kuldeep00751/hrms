<x-base-layout>
    <div class="col-md-12 mx-auto">

        <div class="card">
            <div class="card">

                <div class="card-header">

                    <div class="pull-left">
                        <a href="/system/settings#assessments" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                    </div>

                    <div class="pull-right" role="group">
                        <a href="{{ route('exam_papers.exam_paper.create') }}" class="btn btn-sm btn-primary" title="Create Exam Paper">
                            <i class="fa-solid fa-plus"></i> Add New
                        </a>
                        <a href="{{route('exam_papers.exam_paper.copyForm')}}" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#copy">
                            <i class="fa-solid fa-copy"></i>
                            Copy Exam Papers
                        </a>
                    </div>

                </div>

                @if(count($examPapers) == 0)
                <div class="card-body text-center">
                    <h4>No Exam papers defined.</h4>
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
                                    <th>Academic Year</th>
                                    <th>Exam Type</th>
                                    <th>Paper Name</th>
                                    <th>Min. Pass Mark</th>
                                    <th>Weight</th>
                                    <th>Subminimum Result Code</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($examPapers as $examPaper)
                                <tr>
                                    <td>{{ $examPaper->module->module_name }}</td>
                                    <td>{{ $examPaper->module->module_code }}</td>
                                    <td>{{ $examPaper->academicYear->name }}</td>
                                    <td>{{ optional($examPaper->assessmentType)->assessment_type }}</td>
                                    <td>{{ $examPaper->paper_name }}</td>
                                    <td>{{ $examPaper->minimum_pass_mark }}</td>
                                    <td>{{ $examPaper->weight }}</td>
                                    <td>{{ $examPaper->assessmentResultCode->result_code }}-{{ $examPaper->assessmentResultCode->result_code_description }}</td>
                                    <td>
                                        <a href="{{ route('exam_papers.exam_paper.edit', $examPaper->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
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
    <div class="modal fade modal-dialog-scrollable" tabindex="-1" id="copy" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Copy Exam Papers</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>
                <form method="POST" action="{{ route('exam_papers.exam_paper.copyForm') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="alert alert-info">
                        <strong>Please note!!</strong><br>
                        Any existing data of the academic year you are copying to will be replaced as long as no marks have been captured.
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('academic_year_id') ? 'has-error' : '' }}">
                                    <label for="from_academic_year_id" class="control-label">From Academic Year <span class="text-danger">*</span></label>

                                    <select class="form-control" id="from_academic_year_id" name="from_academic_year_id" required>
                                        <option value="" style="display: none;" {{ old('from_academic_year_id') == '' ? 'selected' : '' }} disabled selected>Select academic year</option>
                                        @foreach ($academicYears as $key => $academicYear)
                                        <option value="{{ $key }}" {{ old('from_academic_year_id') == $key ? 'selected' : '' }}>
                                            {{ $academicYear }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('to_academic_year_id') ? 'has-error' : '' }}">
                                    <label for="to_academic_year_id" class="control-label">To Academic Year <span class="text-danger">*</span></label>

                                    <select class="form-control" id="to_academic_year_id" name="to_academic_year_id" required>
                                        <option value="" style="display: none;" {{ old('to_academic_year_id') == ''  ? 'selected' : ''}} disabled selected>Select academic year</option>
                                        @foreach ($academicYears as $key => $academicYear)
                                        <option value="{{ $key }}" {{ old('to_academic_year_id') == $key ? 'selected' : '' }}>
                                            {{ $academicYear }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=" modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Copy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-base-layout>