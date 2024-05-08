<x-base-layout>
    <div class="col-md-12 mx-auto">

        <div class="card">

            <div class="card-header">
                <div class="pull-left">
                    <a href="{{ route('user_infos.user_info.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Students </a>
                </div>
                <div class="pull-right">
                    <a href="{{ route('user_infos.user_info.create-applications', $info->id) }}" class="btn btn-sm btn-primary" title="Create New Module">
                        <i class="fa-solid fa-plus"></i> Add New Application
                    </a>
                </div>

            </div>

            @if(count($applications) == 0)
            <div class="card-body text-center">
                <div class="alert alert-info">
                    No application information found. Click on the button above to add a new application. You are only allowed {{ $allowed_applications }} application(s) per academic in take.
                </div>
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
                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                    @endforeach
                </ul>
                @endif
                <div class="table-responsive">
                    <div class="row">

                    </div>
                    <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Student Name:') }}</label>
                    {{ $info->first_names }} {{ $info->surname }}
                    <br>
                    <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Student Number:') }}</label>
                    {{ $info->student_number }}
                    <div class="separator separator-dashed mx-5 my-5"></div>
                    <table class="table table-row-dashed">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                <th>Choice Number</th>
                                <th>Academic Year</th>
                                <th>Application Type</th>
                                <th>Intake</th>
                                <th>Qualification</th>
                                <th>Campus</th>
                                <th>Study Mode</th>
                                <th>Application Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $application)
                            <tr>
                                <td>{{ $application->choice_number }}</td>
                                <td>{{ $application->academicYear->name }}</td>
                                <td>{{ $application->applicationType->application_type }}</td>
                                <td>{{ $application->academicIntake->name }}</td>
                                <td>{{ $application->qualification->qualification_name }}</td>
                                <td>{{ $application->campus->name }}</td>
                                <td>{{ $application->studyMode->study_mode }}</td>
                                <td>{{ $application->application_status }}</td>
                                <td>
                                    <a href="{{ route('user_infos.user_info.edit-applications', $application->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Update</a>
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
</x-base-layout>