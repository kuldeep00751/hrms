<x-base-layout>
    <div class="col-md-12 mb-5">
        <div class="card">
            <div class="card-header">
                <strong>Filter Qualification Registrations: </strong>
            </div>
            <form method="GET" action="{{ route('promotion.filter') }}" accept-charset="UTF-8" class="form-horizontal">
                <div class="card-body">
                    <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Student number:') }}</label>
                    <!--end::Label-->
                    <div class="form-group {{ $errors->has('student_number') ? 'has-error' : '' }}">
                        <div class="col-md-12">
                            <input class="form-control" name="student_number" type="number" id="student_number" value="{{ old('student_number', $filterData['student_number'] ?? '') }}" placeholder="Enter student number here...">
                        </div>
                    </div>

                    <div class="separator separator-dashed mx-5 my-5"></div>
                    <div class="row">
                        <div class="col-4">
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase text-right">{{ __('Academic Year') }}</label>
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

                        <!--begin::Col-->
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
                        <div class="col-4">
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Study Mode') }}</label>
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
                    </div>

                    <div class="row">
                        <!--begin::Label-->
                        <div class="col-4">
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Qualification') }}</label>
                            <select name="qualification" aria-label="{{ __('Qualification') }}" data-placeholder="{{ __('Select qualification...') }}" data-control="select2" class="form-select form-select-solid fw-bold">
                                <option value="" style="display: none;" disabled selected>Select Qualification</option>
                                @foreach ($qualifications as $key => $qualification)
                                @if(isset($filterData['qualification']))
                                <option value="{{ $key }}" {{ old('qualification', $filterData['qualification']) == $key ? 'selected' : '' }}>
                                    @else
                                <option value="{{ $key }}">
                                    @endif
                                    {{ $qualification }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Campus') }}</label>
                            <select name="campus" aria-label="{{ __('Campus') }}" data-placeholder="{{ __('Select campus...') }}" class="form-select form-select-solid fw-bold">
                                <option value="" style="display: none;" disabled selected>Select Study Mode</option>
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

                        <div class="col-4">
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Year Level') }}</label>
                            <select name="year_level" aria-label="{{ __('Year Level') }}" data-placeholder="{{ __('Select year level...') }}" class="form-select form-select-solid fw-bold">
                                <option value="" style="display: none;" disabled selected>Select Year Level</option>
                                @foreach ($yearLevels as $key => $yearLevel)
                                @if(isset($filterData['year_level']))
                                <option value="{{ $key }}" {{ old('year_level', $filterData['year_level']) == $key ? 'selected' : '' }}>
                                    @else
                                <option value="{{ $key }}">
                                    @endif
                                    {{ $yearLevel }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="/promotion" class="btn btn-white btn-active-light-primary me-2">{{ __('Reset') }}</a>

                    <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                        {{ __('Search') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-12">
        @if(count($registrations) == 0)
        <div class="card">
            <div class="card-header">
                <h3>Qualification Registrations</h3>
            </div>
            <div class="card-body text-center">
                <div class="alert alert-danger">
                    No registration information found. Please refine your search above
                </div>
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-header">

                <div class="pull-left">
                    <h3>Qualification Registration</h3>
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
                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <i class="fa-solid fa-circle-xmark text-danger"></i>
                    {{ $error }}
                    @endforeach
                </ul>
                @endif
                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">

                        <table class="table table-row-dashed" id="kt_datatable_example">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Student Name</th>
                                    <th>Student Number</th>
                                    <th>Academic Year</th>
                                    <th>Year Level</th>
                                    <th>Qualification</th>
                                    <th>Study Mode</th>
                                    <th>Promotion Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registrations as $registration)
                                <tr>
                                    <td>{{ $registration->userInfo->first_names }} {{ $registration->userInfo->surname }}</td>
                                    <td>{{ $registration->userInfo->student_number }}</td>
                                    <td>{{ $registration->academicYear->name }}</td>
                                    <td>{{ $registration->yearLevel->year_level }}</td>
                                    <td>{{ $registration->qualification->qualification_name }} ({{ $registration->qualification->qualification_code }})</td>
                                    <td>{{ $registration->studyMode->study_mode }}</td>
                                    <td>{!! ($registration->promotion_status) ? $registration->promotionStatus->description : '<span class="badge badge-danger">Not Promoted</span>' !!}</td>
                                    <td>
                                        <a href="#manual-promotion" data-id="{{ $registration->id }}" class="btn btn-sm btn-light btn-active-light-primary manual-promotion" title="Manual Promotion" data-bs-toggle="modal" data-bs-target="#transcript_modal">Manual Promotion</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="modal fade modal-dialog-scrollable modal-xl" tabindex="-1" id="transcript_modal" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Student Academic Transcript for Promotion</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>
                <form method="POST" action="{{ route('promotion.store') }}" accept-charset="UTF-8" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div id="transcript">

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let manualPromotionButtons = document.querySelectorAll('.manual-promotion');

        manualPromotionButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {


                let registrationId = button.dataset.id;

                const url = `/promotion/transcript/${registrationId}`;

                const response = fetch(url, {
                        method: "GET",
                    })
                    .then((response) => response.text())
                    .then((data) => {
                        $("#transcript").html(data)
                    })
            })
        });
    </script>
</x-base-layout>