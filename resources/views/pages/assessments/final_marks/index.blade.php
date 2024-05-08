<x-base-layout>
    <div class="col-md-12 mx-auto mb-5">

        <div class="card">
            <div class="card-header">
                <h3>Filter Exams: </h3>
            </div>
            <form method="GET" action="{{ route('assessments.final_marks.filter') }}" accept-charset="UTF-8" class="form-horizontal">
                <div class="card-body">
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <i class="fa-solid fa-circle-xmark text-danger"></i>
                        {{ $error }}
                        @endforeach
                    </ul>
                    @endif
                    <div class="row mb-2">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-bold fs-6 text-right">{{ __('Academic Year') }}</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <select name="academic_year_id" aria-label="{{ __('Academic Year') }}" data-placeholder="{{ __('Select academic year...') }}" data-control="select2" class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="" style="display: none;" disabled selected>Select Academic Year</option>
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
                        </div>
                    </div>

                    <div class="row mb-2">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-bold fs-6">{{ __('Exam Type') }}</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <select name="assessment_type_id" aria-label="{{ __('Exam Type') }}" data-placeholder="{{ __('Select exam type...') }}" class="form-select form-select-solid form-select-lg fw-bold" required>
                                <option value="" style="display: none;" disabled selected>Select Exam Type</option>
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
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9 bg-white">
                    <a href="{{ route('assessments.final_marks.index') }}" class="btn btn-white btn-active-light-primary me-2">{{ __('Reset') }}</a>

                    <button type="submit" class="btn btn-primary">
                        {{ __('Search') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">

                <div class="pull-left">
                    <h3>Modules</h3>
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

                @if(!count($lecturerModules))
                <div class="alert alert-danger">
                    No module information found. Please refine your search above
                </div>
                @else
                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">

                        <table class="table table-row-dashed" id="kt_datatable_example">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Academic Year</th>
                                    <th>Intake</th>
                                    <th>Campus</th>
                                    <th>Module Name</th>
                                    <th>Module Code</th>
                                    <th>Study Mode</th>
                                    <th>Exam Type</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lecturerModules as $lecturerModule)
                                <tr>
                                    <td>{{ $lecturerModule->academicYear->name }} </td>
                                    <td>{{ $lecturerModule->academicIntake->name }}</td>
                                    <td>{{ $lecturerModule->campus->name }}</td>
                                    <td>{{ $lecturerModule->module->module_name }}</td>
                                    <td>{{ $lecturerModule->module->module_code }}</td>
                                    <td>{{ $lecturerModule->studyMode->study_mode }}</td>
                                    <td>{{ $examType->assessment_type }}</td>
                                    <td>

                                        <form action="{{ route('assessments.final_marks.process') }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="academic_year_id" value="{{$lecturerModule->academic_year_id}}">
                                            <input type="hidden" name="academic_intake_id" value="{{$lecturerModule->academic_intake_id}}">
                                            <input type="hidden" name="campus_id" value="{{$lecturerModule->campus_id}}">
                                            <input type="hidden" name="module_id" value="{{$lecturerModule->module_id}}">
                                            <input type="hidden" name="study_mode_id" value="{{$lecturerModule->study_mode_id}}">
                                            <input type="hidden" name="assessment_type_id" value="{{$examType->id}}">
                                            <input type="hidden" name="module_allocation_id" value="{{$lecturerModule->id}}">

                                            @php
                                            $finalMarksAcademicProcess = $processFinalMarksAcademicProcess->where('academic_intake_id', $lecturerModule->academic_intake_id)->first();
                                            @endphp

                                            @if($finalMarksAcademicProcess)
                                            <button class="btn btn-sm btn-light btn-active-light-primary" type="submit">Process</button>
                                            @endif
                                        </form>
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