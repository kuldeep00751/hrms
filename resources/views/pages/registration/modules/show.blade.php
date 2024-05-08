<x-base-layout>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header">
                    <div class="pull-left">
                        <a href="/registration/modules" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Qualification Registrations </a>
                    </div>
                    <div class="pull-right">
                        <strong>Student Details</strong>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @php
                        $userInfo = $registration->userInfo;
                        @endphp
                        <table class="table table-row-dashed" id="kt_datatable_example">
                            <thead>
                                <tr class="text-gray-400 fw-bold text-uppercase">
                                    <th>Student Number</th>
                                    <th>Surname</th>
                                    <th>First Name</th>
                                    <th>DOB</th>
                                    <th>ID Number/Password</th>
                                    <th>Citizenship Status</th>
                                    <th>Contact Number</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $userInfo->student_number }}</td>
                                    <td>{{ $userInfo->surname }} </td>
                                    <td>{{ $userInfo->first_names }} </td>
                                    <td>{{ $userInfo->date_of_birth }}</td>
                                    <td>{{ $userInfo->id_number }}</td>
                                    <td>{{ $userInfo->citizenship_status }}</td>
                                    <td>{{ $userInfo->mobile_number }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <strong>Qualification Registration Information</strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-row-dashed" id="kt_datatable_example">
                            <thead>
                                <tr class="text-gray-400 fw-bold text-uppercase">
                                    <th>Qualification Name</th>
                                    <th>Study Mode</th>
                                    <th>Year</th>
                                    <th>In take</th>
                                    <th>Campus</th>
                                    <th>Status </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $registration->application->qualification->qualification_name }} ({{ $registration->application->qualification->qualification_code }})</td>
                                    <td>{{ $registration->application->studyMode->study_mode }} </td>
                                    <td>{{ $registration->application->academicYear->name }} </td>
                                    <td>{{ $registration->application->academicIntake->name }}</td>
                                    <td>{{ $registration->application->campus->name }}</td>
                                    <td>{{ isset($registration->application->registration->registrationStatus) ? $registration->application->registration->registrationStatus->status : "Pending" }}</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5 row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <h6>Module Registration</h6>
                    </div>
                </div>
                <form class="form-horizontal" method="post" action="{{ route('registration.modules.process') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="registration_id" value="{{$registration->id}}">

                    <div class="card-body">
                        @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif
                        @if(Session::has('success_message'))
                        <div class="alert alert-success">
                            <h6 class="text-success">
                                <i class="fa-solid fa-circle-check text-success"></i>
                                {!! session('success_message') !!}
                            </h6>
                        </div>
                        @endif
                        <table class="table table-row-dashed table-striped">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Module Name</th>
                                    <th>Module Code</th>
                                    <th>Study Period</th>
                                    <th>Study Mode</th>
                                    <th class="text-center">Tick to Register</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($modules as $module)
                                @php
                                $registeredModule = $moduleRegistration->where('module_id', $module->id)->first();
                                @endphp
                                <tr>
                                    <td>{{ $module->module_name }}</td>
                                    <td>{{ $module->module_code }}</td>
                                    <td>
                                        <div>
                                            @if($registeredModule)
                                            {{ $registeredModule->studyPeriod->study_period }}
                                            @else
                                            @foreach($module->studyPeriods as $studyPeriod)
                                            <div class="mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input border border-primary" type="radio" value="{{$studyPeriod->id}}" id="StudyPeriod_{{$studyPeriod->id}}" name="study_period_id[{{$module->id}}]">
                                                    <label class="form-check-label" for="StudyPeriod_{{$studyPeriod->id}}">{{ $studyPeriod->study_period }}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            @if($registeredModule)
                                            {{ $registeredModule->studyMode->study_mode }}
                                            @else
                                            @foreach($module->studyModes as $studyMode)
                                            <div class=" mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input border border-primary" type="radio" value="{{$studyMode->id}}" id="StudyMode_{{$studyMode->id}}" name="study_mode_id[{{$module->id}}]">
                                                    <label class="form-check-label" for="StudyMode_{{$studyMode->id}}">{{ $studyMode->study_mode }}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if($registeredModule)
                                        <i>{{ $registeredModule->registrationStatus->status }}</i>
                                        @else
                                        <input class="form-check-input border border-primary" type="checkbox" name="module_id[]" value="{{$module->id}}" />
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-header">
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <a href="{{ route('registration.modules.index') }}" class="btn btn-white btn-active-light-primary me-2">{{ __('Discard') }}</a>

                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                                {{ __('Save Changes') }}
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</x-base-layout>