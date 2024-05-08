<x-base-layout>
    <div class="col-md-12 mx-auto mb-5">

        <div class="card">
            <div class="card-header">
                <h3>Filter Suppressions: </h3>
            </div>
            <form method="GET" action="{{ route('assessments.suppressions.filter') }}" accept-charset="UTF-8" class="form-horizontal">
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
                        <label class="col-lg-3 col-form-label fw-bold fs-6 text-right">{{ __('Academic Year') }}</label>
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
                        <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Academic Intake') }}</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <select name="academic_intake_id" aria-label="{{ __('Academic Intake') }}" data-placeholder="{{ __('Select academic intake...') }}" class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="" style="display: none;" disabled selected>Select Academic Intake</option>
                                @foreach ($academicIntakes as $key => $academicIntake)
                                @if(isset($filterData['academic_intake_id']))
                                <option value="{{ $key }}" {{ old('academic_intake_id', $filterData['academic_intake_id']) == $key ? 'selected' : '' }}>
                                    @else
                                <option value="{{ $key }}">
                                    @endif
                                    {{ $academicIntake }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Campus') }}</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <select name="campus_id" aria-label="{{ __('Campus') }}" data-placeholder="{{ __('Campus...') }}" class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="" style="display: none;" disabled selected>Select Campus</option>
                                @foreach ($campuses as $key => $campus)
                                @if(isset($filterData['campus_id']))
                                <option value="{{ $key }}" {{ old('campus_id', $filterData['campus_id']) == $key ? 'selected' : '' }}>
                                    @else
                                <option value="{{ $key }}">
                                    @endif
                                    {{ $campus }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Study Mode') }}</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <select name="study_mode_id" aria-label="{{ __('Study Mode') }}" data-placeholder="{{ __('Select study mode...') }}" class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="" style="display: none;" disabled selected>Select Study Mode</option>
                                @foreach ($studyModes as $key => $studyMode)
                                @if(isset($filterData['study_mode_id']))
                                <option value="{{ $key }}" {{ old('study_mode_id', $filterData['study_mode_id']) == $key ? 'selected' : '' }}>
                                    @else
                                <option value="{{ $key }}">
                                    @endif
                                    {{ $studyMode }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Suppression Mark Type') }}</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <select name="suppression_type" aria-label="{{ __('Suppress Mark Type') }}" data-placeholder="{{ __('Select suppression mark...') }}" class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="" style="display: none;" disabled selected>Select Suppression Mark Type</option>
                                @foreach ($suppressionTypes as $key => $suppressionType)
                                @if(isset($filterData['suppression_type']))
                                <option value="{{ $key }}" {{ old('suppression_type', $filterData['suppression_type']) == $key ? 'selected' : '' }}>
                                    @else
                                <option value="{{ $key }}">
                                    @endif
                                    {{ $suppressionType }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('assessments.suppressions.index') }}" class="btn btn-active-light-primary me-2">{{ __('Reset') }}</a>

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
                    <h3>Marks Suppression</h3>
                </div>
                <div class="pull-right">
                    <a href="{{ route('assessments.suppressions.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-plus"></i> Add New
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

                @if(!count($assessmentSuppressions))
                <div class="alert alert-danger">
                    No suppression information found. Please refine your search above
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
                                    <th>Mark Type</th>
                                    <th>Study Mode</th>
                                    <th>Suppress</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assessmentSuppressions as $assessmentSuppression)
                                <tr>
                                    <td>{{ $assessmentSuppression->academicYear->name }} </td>
                                    <td>{{ $assessmentSuppression->academicIntake->name }}</td>
                                    <td>{{ $assessmentSuppression->campus->name }}</td>
                                    <td>{{ $assessmentSuppression->suppression_type }}</td>
                                    <td>{{ $assessmentSuppression->studyMode->study_mode }}</td>
                                    <td>

                                        <!--begin::Switch-->
                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input suppression-toggle" data-id="{{ $assessmentSuppression->id }}" type="checkbox" value="{{ $assessmentSuppression->suppress_yn }}" {{ ($assessmentSuppression->suppress_yn == 1) ? "checked" : ""}} />
                                        </label>
                                        <!--end::Switch-->
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
    {{ csrf_field() }}
    <script>
        let suppressionToggles = document.querySelectorAll('.suppression-toggle');

        suppressionToggles.forEach(function(suppressionToggle) {
            suppressionToggle.addEventListener('change', function() {

                let suppressionId = suppressionToggle.dataset.id

                let data = {
                    id: suppressionToggle.dataset.id,
                    suppress_yn: (suppressionToggle.checked) ? 1 : 0,
                    '_token': document.getElementsByName("_token")[0].value
                }
                console.log(data)
                const url = 'suppress'

                const response = fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
            })
        })
    </script>
</x-base-layout>