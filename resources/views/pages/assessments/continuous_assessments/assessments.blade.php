<x-base-layout>
    <div class="row">

        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <a href="{{ route('assessments.ca.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Modules </a>
                </div>
                <div class="pull-right">
                    <h3>Capture {{ $continuousAssessmentType->assessment_description }} marks.</h3>
                </div>
            </div>
            <form method="POST" action="{{ route('assessments.ca.store') }}" accept-charset="UTF-8" class="form-horizontal">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="table-responsive">
                        @php $moduleRegistration = $moduleRegistrations->first() @endphp
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
                        <div class="separator separator-dashed mx-5 my-5"></div>

                    </div>
                    @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <h6 class="text-success">
                            <i class="fa-solid fa-circle-check text-success"></i>
                            {!! session('success_message') !!}
                        </h6>
                    </div>
                    @endif

                    <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="table-responsive">

                            <input name="academic_year_id" type="hidden" value="{{$moduleRegistration->academic_year_id}}">
                            <input name="module_id" type="hidden" value="{{$moduleRegistration->module_id}}">
                            <input name="mark_type_id" type="hidden" value="{{$continuousAssessmentType->id}}">
                            <input name="academic_intake_id" type="hidden" value="{{$moduleRegistration->academic_intake_id}}">
                            <input name="campus_id" type="hidden" value="{{$moduleRegistration->campus_id}}">
                            <input name="study_mode_id" type="hidden" value="{{$moduleRegistration->study_mode_id}}">
                            <input name="module_registration_id" type="hidden" value="{{$moduleRegistration->id}}">
                            <div class="col-md-6 mb-5">
                                <label class="control-label"><strong>Search: </strong></label>
                                <input class="form-control" type="text" id="myInput" onkeyup="filterTable()" placeholder="Search by student number, surname, or first name">
                            </div>
                            <table class="table table-striped table-row-bordered table-hover" id="kt_datatable_example">
                                <thead>
                                    <tr class="text-start text-gray-800 fw-bold text-uppercase">
                                        <th class="align-middle w-25">Student Number</th>
                                        <th class="align-middle w-25">Surname</th>
                                        <th class="align-middle w-25">Student Name</th>
                                        <th class="w-25">{{ $continuousAssessmentType->assessment_description }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($moduleRegistrations as $moduleRegistration)
                                    <tr>
                                        <td class="align-middle">{{ $moduleRegistration->student_number }}</td>
                                        <td class="align-middle">
                                            {{ $moduleRegistration->surname }}
                                            <input class="form-control form-control-transparent" name="user_info_id[]" type="hidden" value="{{$moduleRegistration->user_info_id}}">
                                        </td>
                                        <td class="align-middle">
                                            {{ $moduleRegistration->first_names }}
                                        </td>
                                        <td>
                                            @php
                                            $mark = $caMarkTypes->where('user_info_id', $moduleRegistration->user_info_id)->first();
                                            @endphp
                                            <input class="form-control form-control-transparent" value="{{optional($mark)->mark}}" name="mark[{{$moduleRegistration->user_info_id}}]" type="number" placeholder="0.00" max="100" min="0">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9 bg-white">
                    <a href="{{ route('assessments.ca.index') }}" class="btn btn-white btn-active-light-primary me-2">{{ __('Discard') }}</a>

                    <button type="submit" class="btn btn-primary">
                        {{ __('Save Changes') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("wheel", function(event) {
            if (document.activeElement.type === "number") {
                document.activeElement.blur();
            }
        });

        // Javascript code to filter the table
        function filterTable() {
            // Get the input and table elements
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("kt_datatable_example");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those that don't match the search query
            for (i = 0; i < tr.length; i++) {
                // Loop through all table cells in the current row
                for (j = 0; j < 4; j++) {
                    td = tr[i].getElementsByTagName("td")[j];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        }
    </script>
</x-base-layout>