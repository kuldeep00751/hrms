<x-base-layout>
    <div class="col-md-12 mx-auto mb-5">
        <div class="card p-5">
            <form method="GET" action="{{ route('assessments.module_allocations.filter') }}" accept-charset="UTF-8" class="form-horizontal">
                @csrf
                <div class="row mb-2">
                    <!--begin::Col-->
                    <div class="col-4">
                        <!--begin::Label-->
                        <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Module') }}</label>
                        <!--end::Label-->
                        <select name="module" aria-label="{{ __('Module') }}" data-placeholder="{{ __('Select module') }}" data-control="select2" class="form-select form-select-solid fw-bold">
                            <option value="" style="display: none;" disabled selected>Select Application Type</option>
                            @foreach ($modules as $key => $module)
                            @if(isset($filterData['module']))
                            <option value="{{ $key }}" {{ old('module', $filterData['module']) == $key ? 'selected' : '' }}>
                                @else
                            <option value="{{ $key }}">
                                @endif
                                {{ $module }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <!--begin::Col-->
                    <div class="col-4">
                        <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Academic Year') }}</label>
                        <select name="academic_year" aria-label="{{ __('Academic Year') }}" data-placeholder="{{ __('Select academic year...') }}" data-control="select2" class="form-select form-select-solid fw-bold">
                            <option value="" style="display: none;" disabled selected>Select Academic Year</option>
                            @foreach ($academicYears as $key => $academicYear)
                            @if(isset($filterData['academic_year']))
                            <option value="{{ $key }}" {{ old('academic_year', $filterData['academic_year']) == $key ? 'selected' : '' }}>
                                @else
                            <option value="{{ $key }}">
                                @endif
                                {{ $academicYear }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-4">
                        <!--begin::Label-->
                        <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Academic Intake') }}</label>
                        <!--end::Label-->
                        <select name="academic_intake" aria-label="{{ __('Academic Intake') }}" data-placeholder="{{ __('Select academic intake...') }}" class="form-select form-select-solid fw-bold">
                            <option value="" style="display: none;" disabled selected>Select Academic Intake</option>
                            @foreach ($academicIntakes as $key => $academicIntake)
                            @if(isset($filterData['academic_intake']))
                            <option value="{{ $key }}" {{ old('academic_intake', $filterData['academic_intake']) == $key ? 'selected' : '' }}>
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
                    <!--begin::Col-->
                    <div class="col-4">
                        <!--begin::Label-->
                        <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Teaching Staff') }}</label>
                        <!--end::Label-->
                        <select name="teaching_staff" aria-label="{{ __('Teaching Staff') }}" data-placeholder="{{ __('Select teaching staff...') }}" data-control="select2" class="form-select form-select-solid fw-bold">
                            <option value="" style="display: none;" disabled selected>Select Qualification</option>
                            @foreach ($users as $key => $user)
                            @if(isset($filterData['teaching_staff']))
                            <option value="{{ $key }}" {{ old('teaching_staff', $filterData['teaching_staff']) == $key ? 'selected' : '' }}>
                                @else
                            <option value="{{ $key }}">
                                @endif

                                {{ $user }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <!--begin::Label-->
                        <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Study Mode') }}</label>
                        <!--end::Label-->
                        <select name="study_mode" aria-label="{{ __('Study Mode') }}" data-placeholder="{{ __('Select study mode...') }}" class="form-select form-select-solid fw-bold">
                            <option value="" style="display: none;" disabled selected>Select Study Mode</option>
                            @foreach ($studyModes as $key => $studyMode)
                            @if(isset($filterData['study_mode']))
                            <option value="{{ $key }}" {{ old('study_mode', $filterData['study_mode']) == $key ? 'selected' : '' }}>
                                @else
                            <option value="{{ $key }}">
                                @endif
                                {{ $studyMode }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <!--begin::Col-->
                        <!--begin::Label-->
                        <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Campus') }}</label>
                        <!--end::Label-->

                        <select name="campus" aria-label="{{ __('Campus') }}" data-placeholder="{{ __('Select campus...') }}" class="form-select form-select-solid fw-bold">
                            <option value="" style="display: none;" disabled selected>Select Campus</option>
                            @foreach ($campuses as $key => $campus)
                            @if(isset($filterData['campus']))
                            <option value="{{ $key }}" {{ old('campus', $filterData['campus']) == $key ? 'selected' : '' }}>
                                @else
                            <option value="{{ $key }}">
                                @endif
                                {{ $campus }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="separator separator-dashed mx-5 my-5"></div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('assessments.module_allocations.index') }}" class="btn btn-active-light-primary me-2">{{ __('Reset') }}</a>

                    <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
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
                    <h3>Module Allocations</h3>
                </div>
                <div class="pull-right">
                    <a href="{{ route('assessments.module_allocations.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                    <a href="{{route('assessments.module_allocations.copyView')}}" class="btn btn-sm btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="fa-solid fa-copy"></i>
                        Copy Allocations
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

                @if(!count($moduleAllocations))
                <div class="alert alert-danger">
                    No module allocation information found. Please refine your search above
                </div>
                @else
                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">

                        <table class="table table-row-dashed" id="kt_datatable_example">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Module</th>
                                    <th>Academic Year</th>
                                    <th>Intake</th>
                                    <th>Campus</th>
                                    <th>Study Mode</th>
                                    <th>Teaching Staff</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($moduleAllocations as $moduleAllocation)
                                <tr>
                                    <td>{{ $moduleAllocation->module->module_name }} ({{ $moduleAllocation->module->module_code }}) </td>
                                    <td>{{ $moduleAllocation->academicYear->name }} </td>
                                    <td>{{ $moduleAllocation->academicIntake->name }}</td>
                                    <td>{{ $moduleAllocation->campus->name }}</td>
                                    <td>{{ $moduleAllocation->studyMode->study_mode }}</td>
                                    <td>{{ $moduleAllocation->user->first_name }} {{ $moduleAllocation->user->last_name }}</td>
                                    <td>
                                        <a href="{{ route('assessments.module_allocations.edit', $moduleAllocation->id) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>

                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('assessments.module_allocations.destroy', $moduleAllocation->id) }}" accept-charset="UTF-8" class="form-horizontal">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-light btn-active-light-danger">Delete</button>
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
                const url = 'suppressions/suppress'

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