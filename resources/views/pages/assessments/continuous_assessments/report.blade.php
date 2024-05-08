<x-base-layout>
    <div class="row">
        <div class="card">
            <div class="card-body">
                @php
                $moduleRegistration = $moduleRegistrations->first();
                @endphp
                <div class="card-header">
                    <div class="pull-left">
                        <a href="{{ route('assessments.ca.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Modules </a>
                    </div>
                    <div class="pull-right">
                        <h3>{{ $moduleRegistration->module->module_name }} ({{ $moduleRegistration->module->module_code }}) Assessment Marks</h3>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('assessments.ca.download_ca_report', $moduleAllocation->id) }}" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-download"></i> Download CA Report
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table style="width: 50%">
                        <tr>
                            <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Module Name</strong></th>
                            <td>{{ $moduleRegistration->module->module_name }}</td>
                        </tr>
                        <tr>
                            <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Module Code</strong></th>
                            <td>{{ $moduleRegistration->module->module_code }}</td>
                        </tr>
                        <tr>
                            <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Academic Year</strong></th>
                            <td>{{ $moduleRegistration->academicYear->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Academic Intake</strong></th>
                            <td>{{ $moduleRegistration->academicIntake->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Study Mode</strong></th>
                            <td>{{ $moduleRegistration->studyMode->study_mode }}</td>
                        </tr>
                        <tr>
                            <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Campus</strong></th>
                            <td>{{ $moduleRegistration->campus->name }}</td>
                        </tr>
                    </table>
                </div>
                <div class="separator separator-dashed mx-5 my-5"></div>
                <div class="dataTables_wrapper dt-bootstrap4">
                    <div class="table-responsive">
                        <table class="table table-striped table-row-bordered table-hover" id="kt_datatable_example">
                            <thead>
                                <tr class="text-start text-gray-800 fw-bold text-uppercase">
                                    <th>Student Number</th>
                                    <th>Surname</th>
                                    <th>Student Name</th>
                                    @foreach($continuousAssessmentWeights as $weights)
                                    <th class="text-center">{{ $weights->assessment_description }}</th>
                                    @endforeach
                                    <th class="text-center">CA Mark</th>
                                    <th>Attendance</th>
                                    <th>Qualified</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($moduleRegistrations as $moduleRegistration)
                                <tr>
                                    <td>{{$moduleRegistration->student_number}}</td>
                                    <td>{{$moduleRegistration->surname}}</td>
                                    <td>{{$moduleRegistration->first_names}}</td>
                                    @foreach($continuousAssessmentWeights as $weights)
                                    @php
                                    $mark = $caMarkTypes->where('mark_type_id', $weights->id)
                                    ->where('module_id', $moduleRegistration->module_id)
                                    ->where('user_info_id', $moduleRegistration->user_info_id)
                                    ->where('academic_year_id', $moduleRegistration->academic_year_id)
                                    ->where('academic_intake_id', $moduleRegistration->academic_intake_id)
                                    ->where('study_mode_id', $moduleRegistration->study_mode_id)
                                    ->where('campus_id', $moduleRegistration->campus_id)
                                    ->first();
                                    @endphp
                                    <td class="text-center">{{ $mark->mark ?? 0}}</td>
                                    @endforeach
                                    <td class="text-center">
                                        {{ $studentCas->where('user_info_id', $moduleRegistration->user_info_id)->first()->ca_mark ?? 0}}
                                    </td>
                                    <td class="text-center">
                                        {{ $studentCas->where('user_info_id', $moduleRegistration->user_info_id)->first()->attendancePercentage ?? 0 }}%
                                    </td>
                                    <td class="text-center">
                                        @php
                                        $qualified = $studentCas->where('user_info_id', $moduleRegistration->user_info_id)->first()->qualified ?? 'Not Qualified'
                                        @endphp
                                        @if($qualified === 'Qualified')
                                        <i class="fa-solid fa-circle-check text-success"></i>
                                        @else
                                        <i class="fa-solid fa-circle-xmark text-danger"></i>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("wheel", function(event) {
            if (document.activeElement.type === "number") {
                document.activeElement.blur();
            }
        });
    </script>
</x-base-layout>