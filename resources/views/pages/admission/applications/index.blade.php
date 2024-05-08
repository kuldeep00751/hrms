<x-base-layout>
    <div class="row">
        <div class="col-md-12 mb-5">

            <div class="bg-white p-5">
                <form method="GET" action="{{ route('admission.applications.filter') }}" accept-charset="UTF-8" class="form-horizontal">
                    <div class="fv-row">
                        <!--begin::Label-->
                        <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Student number:') }}</label>
                        <!--end::Label-->
                        <div class="form-group {{ $errors->has('student_number') ? 'has-error' : '' }}">
                            <div class="col-md-12">
                                <input class="form-control" name="student_number" type="number" id="student_number" value="{{ old('student_number', $filterData['student_number'] ?? '') }}" placeholder="Enter student number here...">
                            </div>
                        </div>

                    </div>
                    <div class="separator separator-dashed mx-5 my-5"></div>

                    <div class="row mb-2">
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

                        <!--begin::Col-->
                        <div class="col-4">
                            <!--begin::Label-->
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Application Type') }}</label>
                            <!--end::Label-->
                            <select name="application_type" aria-label="{{ __('Application Type') }}" data-placeholder="{{ __('Select application type...') }}" class="form-select form-select-solid fw-bold">
                                <option value="" style="display: none;" disabled selected>Select Application Type</option>
                                @foreach ($applicationTypes as $key => $applicationType)
                                @if(isset($filterData['application_type']))
                                <option value="{{ $key }}" {{ old('application_type', $filterData['application_type']) == $key ? 'selected' : '' }}>
                                    @else
                                <option value="{{ $key }}">
                                    @endif
                                    {{ $applicationType }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <!--begin::Col-->
                        <div class="col-4">
                            <!--begin::Label-->
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Qualification') }}</label>
                            <!--end::Label-->
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

                    <div class="card-footer d-flex justify-content-end">
                        <a href="/admission/applications" class="btn btn-active-light-primary me-2">{{ __('Reset') }}</a>

                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                            {{ __('Search') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            @if(count($applications) == 0)
            <div class="card">
                <div class="card-header">
                    <h3>Applications</h3>
                </div>
                <div class="card-body text-center">
                    <div class="alert alert-danger">
                        No application information found. Please refine your search above
                    </div>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header">

                    <div class="pull-left">
                        <strong>Applications</strong>
                    </div>
                    <div class="pull-right">
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <button type="button" class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#documents-upload">
                                <i class="fa-solid fa-download"></i>
                                Download Applications
                            </button>


                            <!--begin::Hide default export buttons-->
                            <div id="kt_datatable_example_buttons" class="d-none"></div>
                            <!--end::Hide default export buttons-->
                        </div>
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

                            <table class="table table-hover table-bordered" id="kt_datatable_example" style="font-size: 12px; cursor: pointer;">
                                <thead>
                                    <tr class="text-gray-400 fw-bold text-uppercase">
                                        <th>Student Number</th>
                                        <th>Student Name</th>
                                        <th>Academic Year</th>
                                        <th>Qualification</th>
                                        <th>Campus</th>
                                        <th>Application Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($applications as $application)
                                    <tr onclick="window.location.href = '{{ route('admission.application.show', $application->id) }}';">
                                        <td>{{ $application->userInfo->student_number }}</td>
                                        <td>{{ $application->userInfo->first_names }} {{ $application->userInfo->surname }}</td>
                                        <td>{{ $application->academicYear->name }}</td>
                                        <td>{{ $application->qualification->qualification_name }}</td>
                                        <td>{{ $application->campus->name }}</td>
                                        <td>{{ $application->application_status }}</td>

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
    </div>

    <div class="modal fade modal-dialog-scrollable" tabindex="-1" id="documents-upload" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Download applications</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <form method="POST" action="{{ route('admission.application.export') }}" accept-charset="UTF-8" class="form-horizontal" id="download-applications">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="alert alert-success d-none" id="wait-message">
                            <strong>Please wait, your file is getting ready... <div class="spinner-border spinner-border-sm text-success" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div></strong>
                        </div>

                        <div class="row mb-2">
                            <!--begin::Col-->
                            <div class="col-6">
                                <label class="col-form-label required">{{ __('Academic Year') }}</label>
                                <select name="academic_year" aria-label="{{ __('Academic Year') }}" data-placeholder="{{ __('Select academic year...') }}" class="form-select form-select-solid fw-bold" required>
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

                            <div class="col-6">
                                <!--begin::Label-->
                                <label class="col-form-label required">{{ __('Academic Intake') }}</label>
                                <!--end::Label-->
                                <select name="academic_intake" aria-label="{{ __('Academic Intake') }}" data-placeholder="{{ __('Select academic intake...') }}" class="form-select form-select-solid fw-bold" required>
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
                            <div class="col-6">
                                <!--begin::Label-->
                                <label class="col-form-label required">{{ __('Application Type') }}</label>
                                <!--end::Label-->
                                <select name="application_type" aria-label="{{ __('Application Type') }}" data-placeholder="{{ __('Select application type...') }}" class="form-select form-select-solid fw-bold" required>
                                    <option value="" style="display: none;" disabled selected>Select Application Type</option>
                                    @foreach ($applicationTypes as $key => $applicationType)
                                    @if(isset($filterData['application_type']))
                                    <option value="{{ $key }}" {{ old('application_type', $filterData['application_type']) == $key ? 'selected' : '' }}>
                                        @else
                                    <option value="{{ $key }}">
                                        @endif
                                        {{ $applicationType }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6">
                                <!--begin::Col-->
                                <!--begin::Label-->
                                <label class="col-form-label required">{{ __('Campus') }}</label>
                                <!--end::Label-->

                                <select name="campus" aria-label="{{ __('Campus') }}" data-placeholder="{{ __('Select campus...') }}" class="form-select form-select-solid fw-bold" required>
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

                            <!--begin::Col-->
                            <div class="col-12">
                                <!--begin::Label-->
                                <label class="col-form-label required">{{ __('Qualification') }}</label>
                                <!--end::Label-->
                                <select name="qualification" aria-label="{{ __('Qualification') }}" data-placeholder="{{ __('Select qualification...') }}" data-control="select2" class="form-select form-select-solid fw-bold" required>
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
                        </div>
                    </div>

                    <div class=" modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="request_file">Request file</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var button = document.querySelector("#request_file");

        var waitMessage = document.querySelector("#wait-message");

        document.getElementById('download-applications').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            // Collect form data
            var formData = new FormData(event.target);

            // Send form data to the server
            fetch('/admission/applications/export', {
                    method: 'POST',
                    body: formData
                })
                .then(function(response) {
                    // Handle button click event

                    // Handle the response from the server
                    if (response.ok) {
                        waitMessage.classList.remove('d-none');

                        let myInterval = setInterval(function() {
                            fetch('/notifications')
                                .then(function(response) {
                                    if (!response.ok) {
                                        throw new Error('Network response was not OK');
                                    }
                                    return response.json();
                                })
                                .then(function(data) {
                                    // Handle the received notifications
                                    //console.log(data)
                                    window.location.replace(`/admission/applications/${data}/download`);

                                    if (data) {
                                        waitMessage.classList.add('d-none');
                                        stopFileDownload(myInterval);
                                    }

                                })
                                .catch(function(error) {
                                    console.error(error);
                                });
                        }, 5000); // Execute every 5 seconds (adjust as needed)
                        // Additional logic after successful form submission
                    } else {
                        console.error('Form submission failed');
                        // Additional error handling logic
                    }
                })
                .catch(function(error) {
                    console.error('An error occurred during form submission', error);
                    // Additional error handling logic
                });
        });

        function stopFileDownload(myInterval) {
            clearInterval(myInterval);
        }
    </script>

</x-base-layout>