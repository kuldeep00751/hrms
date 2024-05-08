<x-base-layout>
    <div class="row">
        <div class="col-md-12 mb-5">

            <div class="bg-white p-5">
                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach

                </ul>
                @endif
                <form method="POST" action="{{ route('proof_of_registration.show') }}" accept-charset="UTF-8" class="form-horizontal">
                    @csrf
                    <div class="row">


                        <div class="col-6">
                            <!--begin::Label-->
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Student number:') }}</label>
                            <!--end::Label-->
                            <div class="form-group {{ $errors->has('student_number') ? 'has-error' : '' }}">
                                <div class="col-md-12">
                                    <input class="form-control" name="student_number" type="number" id="student_number" value="{{ old('student_number', $filterData['student_number'] ?? '') }}" placeholder="Enter student number here...">
                                </div>
                            </div>

                        </div>

                        <div class="col-6">
                            <!--begin::Label-->
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('ID Number/Passport:') }}</label>
                            <!--end::Label-->
                            <div class="form-group {{ $errors->has('id_number') ? 'has-error' : '' }}">
                                <div class="col-md-12">
                                    <input class="form-control" name="id_number" type="text" id="id_number" value="{{ old('id_number', $filterData['id_number'] ?? '') }}" placeholder="Enter ID or Passport number here...">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="separator separator-dashed mx-5 my-5"></div>

                    <div class="d-flex justify-content-end">

                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                            {{ __('Search') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @if(count($studentRegistration))
        <div class="card">
            <div class="card-header">
                <strong>Qualification Registration Information</strong>
            </div>
            <div class="card-body">
                <h3 class="fw-bold mb-5">Student</h3>
                <div class="row">
                    <!--begin::Label-->
                    <label class="col-md-3 fw-bold text-muted">{{ __('Student Name') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bolder fs-6 text-dark">{{ $userInfo->first_names }} {{ $userInfo->surname }} </span>
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row">
                    <!--begin::Label-->
                    <label class="col-md-3 fw-bold text-muted">{{ __('Student Number') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bolder fs-6 text-dark">{{ $userInfo->student_number }} </span>
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row">
                    <!--begin::Label-->
                    <label class="col-md-3 fw-bold text-muted">{{ __('ID Number') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bolder fs-6 text-dark">{{ $userInfo->id_number }} </span>
                    </div>
                    <!--end::Col-->
                </div>
                <hr>
                <div class="table-responsive">

                    <table class="table table-row-dashed" id="kt_datatable_example">
                        <thead>
                            <tr class="text-gray-400 fw-bold text-uppercase">
                                <th>Qualification Name</th>
                                <th>Study Mode</th>
                                <th>Year</th>
                                <th>Year Level</th>
                                <th>In take</th>
                                <th>Campus</th>
                                <th>Status </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studentRegistration as $registration)
                            <tr>
                                <td>{{ $registration->qualification->qualification_name }} ({{ $registration->qualification->qualification_code }})</td>
                                <td>{{ $registration->studyMode->study_mode }} </td>
                                <td>{{ $registration->academicYear->name }} </td>
                                <td class="text-center">{{ $registration->yearLevel->year_level }} </td>
                                <td>{{ $registration->academicIntake->name }}</td>
                                <td>{{ $registration->campus->name }}</td>
                                <td>{{ $registration->registrationStatus->status }}</td>
                                <td>
                                    <a href="{{ route('proof_of_registration.modules.show', [$registration->id]) }}" class="btn btn-sm btn-light btn-active-light-primary" title="Show Info">Show</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</x-base-layout>