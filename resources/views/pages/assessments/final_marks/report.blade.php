<x-base-layout>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <div class="pull-left">
                        <a href="{{ route('assessments.final_marks.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Modules </a>
                    </div>
                    <div class="pull-right">
                        <h3>{{ $moduleAllocation->module->module_name }} ({{ $moduleAllocation->module->module_code }}) Final Marks</h3>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('assessments.final_marks.download_exam_report', [$moduleAllocation->id, $assessmentTypeId]) }}" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-download"></i> Download Exam Report
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table style="width: 50%">
                        <tr>
                            <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Module Name</strong></th>
                            <td>{{ $moduleAllocation->module->module_name }}</td>
                        </tr>
                        <tr>
                            <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Module Code</strong></th>
                            <td>{{ $moduleAllocation->module->module_code }}</td>
                        </tr>
                        <tr>
                            <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Exam Type</strong></th>
                            <td>{{ $assessmentType->assessment_type }} ({{ $assessmentType->assessment_type_code }})</td>
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
                                    <th class="text-center">CA</th>
                                    <th class="text-center">Exam Mark</th>
                                    <th class="text-center">Final Mark</th>
                                    <th class="text-center">Pass/Fail</th>
                                    <th class="text-center">Result Code</th>
                                    <th class="text-center">Result Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($studentFinalMarks as $studentFinalMark)
                                <tr>
                                    <td>{{$studentFinalMark->student_number}}</td>
                                    <td>{{$studentFinalMark->surname}}</td>
                                    <td>{{$studentFinalMark->first_names}}</td>
                                    <td class="text-center">{{ (count($studentFinalMark->continuousAssessment)) ? $studentFinalMark->continuousAssessment->first()->ca_mark : 0}}</td>
                                    <td class="text-center">{{ (count($studentFinalMark->examinationMark)) ? $studentFinalMark->examinationMark->first()->exam_mark : 0}}</td>
                                    <td class="text-center">{{ $studentFinalMark->final_mark ?? 0}}</td>
                                    <td class="text-center">{{ $studentFinalMark->pass_fail ?? ''}}</td>
                                    <td class="text-center">{{ $studentFinalMark->assessmentResultCode->result_code ?? ''}}</td>
                                    <td class="text-center">{{ $studentFinalMark->assessmentResultCode->result_code_description ?? ''}}</td>
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