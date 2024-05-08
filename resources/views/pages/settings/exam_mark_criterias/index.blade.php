<x-base-layout>

    <div class="col-md-12 mb-5">
        <div class="card">
            <div class="card-header">
                <strong>Search Exam Mark Grading Scale: </strong>
            </div>
            <form method="GET" action="{{ route('exam_mark_criterias.exam_mark_criteria.filter') }}" accept-charset="UTF-8" class="form-horizontal">
                <div class="card-body">

                    <div class="row mb-5">
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('module_id') ? 'has-error' : '' }}">
                                <label for="module_id" class="control-label"><strong>Module <span class="text-danger">*</span></strong></label>

                                <select class="form-control grading-parameter" id="module_id" name="module_id" data-control="select2" required>
                                    <option value="" style="display: none;" {{ old('module_id') == '' ? 'selected' : '' }} disabled selected>Select module</option>
                                    @foreach ($modules as $key => $module)
                                    @if(isset($filterData['module_id']))
                                    <option value="{{ $key }}" {{ old('module_id', $filterData['module_id']) == $key ? 'selected' : '' }}>
                                        @else
                                    <option value="{{ $key }}">
                                        @endif
                                        {{ $module }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('academic_year_id') ? 'has-error' : '' }}">
                                <label for="academic_year_id" class="control-label"><strong>Academic Year <span class="text-danger">*</span></strong></label>

                                <select class="form-control grading-parameter" id="academic_year_id" name="academic_year_id" required>
                                    <option value="" style="display: none;" {{ old('academic_year_id') == '' ? 'selected' : '' }} disabled selected>Select academic year</option>
                                    @foreach ($academicYears as $key => $academicYear)
                                    @if(isset($filterData['academic_year_id']))
                                    <option value="{{ $key }}" {{ old('academic_year_id', $filterData['academic_year_id']) == $key ? 'selected' : '' }}>
                                        @else
                                    <option value="{{ $key }}">
                                        @endif
                                        {{ $academicYear }}
                                    </option>
                                    @endforeach
                                </select>
                                {!! $errors->first('academic_year_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('assessment_type_id') ? 'has-error' : '' }}">
                                <label for="assessment_type_id" class="control-label"><strong>Exam Type <span class="text-danger">*</span></strong></label>

                                <select class="form-control grading-parameter" id="assessment_type_id" name="assessment_type_id" required>
                                    <option value="" style="display: none;" {{ old('assessment_type_id') == '' ? 'selected' : '' }} disabled selected>Select Exam Type</option>
                                    @foreach ($assessmentTypes as $key => $assessmentType)
                                    @if(isset($filterData['assessment_type_id']))
                                    <option value="{{ $key }}" {{ old('assessment_type_id', $filterData['assessment_type_id']) == $key ? 'selected' : '' }}>
                                        @else
                                    <option value="{{ $key }}">
                                        @endif
                                        {{ $assessmentType }}
                                    </option>
                                    @endforeach
                                </select>
                                {!! $errors->first('assessment_type_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="/exam_mark_criterias" class="btn btn-white btn-active-light-primary me-2">{{ __('Reset') }}</a>

                    <button type="submit" class="btn btn-primary">
                        {{ __('Search') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12">

        <div class="card">
            <div class="card">

                <div class="card-header">

                    <div class="pull-left">
                        <a href="/system/settings#assessments" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                    </div>

                    <div class="pull-right" role="group">
                        <a href="{{ route('exam_mark_criterias.exam_mark_criteria.create') }}" class="btn btn-sm btn-primary" title="Create Exam Mark Grading Scale">
                            <i class="fa-solid fa-plus"></i> Add New
                        </a>
                        <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#copy">
                            <i class="fa-solid fa-copy"></i>
                            Copy Exam Mark Grading Scale
                        </a>
                    </div>

                </div>
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
                                    <th>Module Name</th>
                                    <th>Module Code</th>
                                    <th class="text-center">Academic Year</th>
                                    <th>Exam Type</th>
                                    <th>Mark Range</th>
                                    <th>Result</th>
                                    <th class="text-center">Pass/Fail</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($examMarkCriterias as $examMarkCriteria)
                                <tr>
                                    <td>{{ $examMarkCriteria->module->module_name }}</td>
                                    <td>{{ $examMarkCriteria->module->module_code }}</td>
                                    <td class="text-center">{{ $examMarkCriteria->academicYear->name }}</td>
                                    <td>{{ optional($examMarkCriteria->assessmentType)->assessment_type }}</td>
                                    <td>{{ $examMarkCriteria->min_mark }} - {{ $examMarkCriteria->max_mark }}</td>
                                    <td>{{ $examMarkCriteria->assessmentResultCode->result_code }} - {{ $examMarkCriteria->assessmentResultCode->result_code_description }}</td>
                                    <td class="text-center">{{ $examMarkCriteria->assessmentResultCode->pass_fail }} </td>
                                    <td>
                                        <a href="{{ route('exam_mark_criterias.exam_mark_criteria.edit', $examMarkCriteria->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="8">
                                        <div class="alert alert-danger">
                                            No data found.
                                        </div>
                                    </th>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-dialog-scrollable" tabindex="-1" id="copy" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Copy Exam Mark Grading</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>
                <form method="POST" action="{{ route('exam_mark_criterias.exam_mark_criteria.copy') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
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