<x-base-layout>
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">

                <div class="pull-left">
                    <a href="{{ route('assessments.attendance_register.index', $moduleAllocation->id) }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Attendance Registers </a>
                </div>
                <div class="pull-right">
                    <h3>Create New Attendance Register</h3>
                </div>
            </div>
            <form method="post" action="{{ route('assessments.attendance_register.store') }}">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <table style="width: 50%" class="table table-bordered">
                        <tr>
                            <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Module Name</strong></th>
                            <td>{{ $moduleAllocation->module->module_name }}</td>
                        </tr>
                        <tr>
                            <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Module Code</strong></th>
                            <td>{{ $moduleAllocation->module->module_code }}</td>
                        </tr>
                        <tr>
                            <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Academic Year</strong></th>
                            <td>{{ $moduleAllocation->academicYear->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Academic Intake</strong></th>
                            <td>{{ $moduleAllocation->academicIntake->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Study Mode</strong></th>
                            <td>{{ $moduleAllocation->studyMode->study_mode }}</td>
                        </tr>
                        <tr>
                            <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Campus</strong></th>
                            <td>{{ $moduleAllocation->campus->name }}</td>
                        </tr>
                    </table>
                    <div class="separator separator-dashed mx-5 my-5"></div>

                    {{ csrf_field() }}
                    @include ('pages.assessments.my_modules.attendance_register.form', [
                    'attendanceRegister' => null,
                    ])
                </div>

                <div class="card-header">
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <a href="{{ route('assessments.attendance_register.index', $moduleAllocation->id) }}" class="btn btn-white btn-active-light-primary me-2">{{ __('Discard') }}</a>

                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                            {{ __('Save Changes') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>