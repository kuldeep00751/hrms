<div class="table-responsive">
    @php
    $moduleRegistration = $moduleRegistrations->first();
    @endphp
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
                    <th class="text-center">Attendace</th>
                    <th class="text-center">Qualified (Yes/No)</th>
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
                    <td>
                        {{ $studentCas->where('user_info_id', $moduleRegistration->user_info_id)->first()->attendancePercentage ?? 0}}%
                    </td>
                    <td>
                        {{ $studentCas->where('user_info_id', $moduleRegistration->user_info_id)->first()->qualified ?? 0}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>