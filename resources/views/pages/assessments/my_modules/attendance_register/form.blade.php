<div class="row mb-10">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('attendance_date') ? 'has-error' : '' }}">
            <label for="attendance_date" class="control-label">Attendance Date <span class="text-danger">*</span></label>
            <input class="form-control" name="attendance_date" type="date" id="attendance_date" value="{{ old('attendance_date', optional($attendanceRegister)->attendance_date) }}" required>
            <input class="form-control" name="module_id" type="hidden" id="module_id" value="{{ $moduleAllocation->module_id }}">
            <input class="form-control" name="academic_year_id" type="hidden" value="{{ $moduleAllocation->academic_year_id }}">
            <input class="form-control" name="academic_intake_id" type="hidden" value="{{ $moduleAllocation->academic_intake_id }}">
            <input class="form-control" name="study_mode_id" type="hidden" value="{{ $moduleAllocation->study_mode_id }}">
            <input class="form-control" name="campus_id" type="hidden" value="{{ $moduleAllocation->campus_id }}">
            <input class="form-control" name="module_allocation_id" type="hidden" value="{{ $moduleAllocation->id }}">
        </div>
    </div>
    <div class="col-md-6">
        <label for="attendance_date" class="control-label"><strong>Search: </strong></label>
        <input class="form-control" type="text" id="myInput" onkeyup="filterTable()" placeholder="Search by student number, surname, or first name">
    </div>
</div>

<div class="dataTables_wrapper dt-bootstrap4 no-footer">
    <div class="table-responsive">
        <table class="table table-row-dashed table-striped table-hover table-bordered" id="myTable" style="width: 100%;">
            <thead>
                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                    <th> <input class="form-check-input border border-primary" type="checkbox" id="header-checkbox" /> Select</th>
                    <th>Hours Attended</th>
                    <th>Student Number</th>
                    <th>First Name</th>
                    <th>Surname</th>
                </tr>
            </thead>
            <tbody>
                @foreach($moduleRegistrations as $moduleRegistration)
                <tr>
                    <td>
                        <input class="form-check-input border border-primary column-checkbox" type="checkbox" name="user_info_id[]" value="{{$moduleRegistration->user_info_id}}" />
                    </td>
                    <td style="width: 200px; padding-right: 10px;">
                        <input class="form-control col-md-6" name="attendance_duration[]" type="number" id="attendance_duration" value="{{ $moduleAllocation->module->lecture_duration }}">
                        <input class="form-control" name="student_number[]" type="hidden" id="attendance_duration" value="{{ $moduleRegistration->student_number }}">
                        <input class="form-control" name="first_names[]" type="hidden" id="attendance_duration" value="{{ $moduleRegistration->first_names }}">
                        <input class="form-control" name="surname[]" type="hidden" id="attendance_duration" value="{{ $moduleRegistration->surname }}">
                    </td>
                    <td>{{ $moduleRegistration->student_number }}</td>
                    <td>{{ $moduleRegistration->first_names }}</td>
                    <td>{{ $moduleRegistration->surname }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    // get the header checkbox element
    const headerCheckbox = document.getElementById('header-checkbox');

    // get all the checkboxes in the column
    const columnCheckboxes = document.querySelectorAll('.column-checkbox');

    // add an event listener to the header checkbox
    headerCheckbox.addEventListener('change', function() {
        // loop through all the checkboxes in the column
        for (let i = 0; i < columnCheckboxes.length; i++) {
            // check or uncheck each checkbox based on the header checkbox state
            columnCheckboxes[i].checked = headerCheckbox.checked;
        }
    });

    // Javascript code to filter the table
    function filterTable() {
        // Get the input and table elements
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
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