<x-base-layout>
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">

                <div class="pull-left">
                    <h3>Module</h3>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lecturerModules as $lecturerModule)
                                <tr>
                                    <td>{{ $lecturerModule->academicYear->name }} </td>
                                    <td>{{ $lecturerModule->academicIntake->name }}</td>
                                    <td>{{ $lecturerModule->campus->name }}</td>
                                    <td>{{ $lecturerModule->module->module_name }}</td>
                                    <td>{{ $lecturerModule->module->module_code }}</td>
                                    <td>{{ $lecturerModule->studyMode->study_mode }}</td>
                                    <td>
                                        <!--begin::Action menu-->
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen052.svg-->
                                            Assessment Marks
                                            <!--end::Svg Icon-->
                                        </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            @php
                                            $caAssessmentTypes = $continuousAssessmentTypes
                                            ->where('academic_year_id', $lecturerModule->academic_year_id)
                                            ->where('module_id', $lecturerModule->module_id);

                                            @endphp

                                            @foreach ($caAssessmentTypes as $continuousAssessmentType)
                                            <div class="menu-item px-3">
                                                <a href="{{ route('assessments.ca.show', [$lecturerModule->id, $continuousAssessmentType->id]) }}" class="menu-link px-3">{{ $continuousAssessmentType->assessment_description }}</a>
                                            </div>
                                            @endforeach
                                            <div class="menu-item px-3">
                                                <a href="{{ route('assessments.ca.report', $lecturerModule->id) }}" class="menu-link px-3">View all</a>
                                            </div>
                                        </div>
                                        <!--end::Menu-->
                                        <!--end::Action menu-->
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