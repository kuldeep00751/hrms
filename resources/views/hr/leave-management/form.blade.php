
<input name="id" type="hidden" id="leave_id" value="{{ old('id', isset($leaveManage) ? $leaveManage->id : 0) }}">
<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('employee_id') ? 'has-error' : '' }}">
            <label for="employee_id" class="control-label">Employee <span class="text-danger">*</span></label>

            <select class="form-control" id="employee_id" name="employee_id" data-control="select2"required>
                <option value="">Select Employee</option>
                @foreach ($employeeList as $employee)
                <option value="{{ $employee->id }}" {{ old('employee_id', optional($leaveManage)->employee_id) == $employee->id ? 'selected' : '' }}>
                    {{ ucfirst($employee->first_name) }}  {{ ucfirst($employee->last_name)}}
                </option>
                @endforeach
            </select>
            {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('leaveType_id') ? 'has-error' : '' }}">
            <label for="leaveType_id" class="control-label">Leave Type <span class="text-danger">*</span></label>

            <select class="form-control" id="leaveType_id" name="leaveType_id" required>
                <!-- <option value="">Select Leave Type</option>
                @foreach ($leaveTypes as $key => $value)
                <option value="{{ $key }}" {{ old('leaveType_id', optional($leaveManage)->leaveType_id) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
                @endforeach -->
            </select>
            <label for="available_days" id="available_days" class="control-label m-1"></label>
            <input class="form-control" name="available_days_data" type="hidden"  id="available_days_data" value="0">
            <input class="form-control" name="leave_type" type="hidden"  id="leave_type" value="{{ old('leave_type', isset($leaveManage) ? $leaveManage->leave_type : '') }}">
            {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
            <label for="start_date" class="control-label">Start Date <span class="text-danger">*</span></label>
            <input class="form-control" autocomplete="off" name="start_date" type="date" required id="start_date" value="{{ old('start_date', isset($leaveManage) ? date('Y-m-d', strtotime($leaveManage->start_date)) : date('Y-m-d')) }}">   
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
            <label for="end_date" class="control-label">End Date <span class="text-danger">*</span></label>
            <input class="form-control" autocomplete="off" name="end_date" type="date" required id="end_date" value="{{ old('end_date', isset($leaveManage) ? date('Y-m-d', strtotime($leaveManage->end_date)) : date('Y-m-d')) }}">   
        </div>
    </div>
</div>
<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('total_days') ? 'has-error' : '' }}">
            <label for="total_days" class="control-label">Total Days <span class="text-danger"></span></label>
            <input class="form-control" autocomplete="off" name="total_days" readonly type="number" id="total_days" min="0" value="{{ old('total_days', $leaveManage->total_days ?? '1') }}" >   
        </div>
        <label for="publicHoliday_days" id="publicHoliday_days" class="control-label m-1"></label>
    </div>
</div>
<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('leave_reason') ? 'has-error' : '' }}">
            <label for="leave_reason" class="control-label">Leave Reason <span class="text-danger">*</span></label>

            <textarea class="form-control" name="leave_reason" id="leave_reason" required>{{ old('leave_reason', $leaveManage->leave_reason ?? '') }}</textarea>
            {!! $errors->first('leave_reason', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('attachments') ? 'has-error' : '' }}">
            <label for="attachments" class="control-label">Attachments </label>

            <input class="form-control" name="attachments[]" type="file" id="attachments" multiple>
        </div>
    </div>
</div>

@if($leaveManage)
<div class="row mb-5">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('attachments') ? 'has-error' : '' }}">
            <label for="attachments" class="control-label"><strong>Uploaded Attachments: </strong></label>
            <table class="table">
                @forelse($leaveManage->attachments as $attachment)
                <tr>
                    <td>{{$attachment->document_name }}</td>
                    <td>
                        <a href="{{ route('leave-manages.leave-manage.delete-attachment', $attachment->id) }}" onclick="return confirm('Are you sure you want to delete this attachment?')">
                            <i class="fa-solid fa-trash text-danger"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <div class="alert alert-warning text-black">
                    There are no attachments for this notice.
                </div>
                @endforelse
            </table>
        </div>
    </div>
</div>
@endif
 
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var currentDate = new Date().toISOString().split('T')[0];
        //document.getElementById('start_date').min = currentDate;
        document.getElementById('start_date').addEventListener('change', function() {
            var startDateValue = this.value;
            document.getElementById('end_date').min = startDateValue;
        });
    });    
    document.addEventListener("DOMContentLoaded", function() {

        function loadLeaveTypes() {
            var employeeDropdown = document.getElementById('employee_id');
            var selectedEmployeeId = employeeDropdown.value;
            var leaveType_id = document.getElementById('leaveType_id');
            var available_days = document.getElementById('available_days');
            var token = document.getElementsByName("_token")[0].value;

            let data = {
                employee_id: selectedEmployeeId,
                '_token': token
            };

            const url = "{{ route('employees.get-leaveType') }}";

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json()) // Parse JSON response
            .then(data => {
                leaveType_id.innerHTML = data.options;
                var selectedLeaveTypeId = "{{ old('leaveType_id', optional($leaveManage)->leaveType_id) }}";
                leaveType_id.value = selectedLeaveTypeId;
            })
            .catch(error => console.error('Error:', error)); // Handle any errors

            leaveType_id.selectedIndex = 0;
            available_days.innerHTML = '';
        }

        loadLeaveTypes();
        var employeeDropdown = document.getElementById('employee_id');
        var select2Instance = $(employeeDropdown).select2();
        select2Instance.on('change', loadLeaveTypes);
    });


    function totaldayscount(){}
        document.addEventListener('DOMContentLoaded', function(){
        var startDateInput = document.getElementById('start_date');
        var endDateInput = document.getElementById('end_date');
        var totalDaysInput = document.getElementById('total_days');
        var leaveType  = document.getElementById('leaveType_id');
        var employee = document.getElementById('employee_id');
        var leaveId  = document.getElementById('leave_id').value;

        function calculateDays() {
            if(employee.value =='' || employee.value ==null){
                Swal.fire({
                    text: "Select Employee",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                });
                return false;
            }
            if(leaveType.value =='' || leaveType.value ==null){
                Swal.fire({
                    text: "Select leave Type",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                });
                return false;
            } 
            
            var startDate = new Date(startDateInput.value);
            var endDate = new Date(endDateInput.value);
            var employee_id = employee.value;

            let data = {
                startDate: startDate,
                endDate: endDate,
                employee_id:employee_id,
                leaveId: leaveId,
                '_token': document.getElementsByName("_token")[0].value
            }
            const url = "{{ route('employees.get-used-days') }}";

            const response = fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then(response => response.json()) // Parse JSON response
            .then(data => {
                // if(data.available_days >0){
                //     Swal.fire({
                //         text: "Selected leave dates already used",
                //         icon: "warning",
                //         buttonsStyling: false,
                //         confirmButtonText: "Ok, got it!",
                //         customClass: {
                //             confirmButton: "btn btn-primary",
                //         },
                //     }).then((result) => {
                //         if (result.isConfirmed) {
                //             var difference = endDate - startDate;
                //             var daysDifference = Math.ceil(difference / (1000 * 60 * 60 * 24));
                            
                //             if (daysDifference === 0) {
                //                 totalDaysInput.value = 1;
                //             } else {
                //                 if(data.publicHoliday >0){
                //                     totalDaysInput.value = 1+daysDifference - data.publicHoliday;
                //                     document.getElementById('publicHoliday_days').innerHTML = 'Public Holidays: ' + data.publicHoliday;
                //                 }else{
                //                     totalDaysInput.value = 1+daysDifference;
                //                 }
                                
                //             }
                //         }
                //     });
                // }else{
                //     var difference = endDate - startDate;
                //     var daysDifference = Math.ceil(difference / (1000 * 60 * 60 * 24));
                    
                //     if (daysDifference === 0) {
                //         totalDaysInput.value = 1;
                //     } else {
                //         if(data.publicHoliday >0){
                //             totalDaysInput.value = 1+daysDifference - data.publicHoliday;
                //             document.getElementById('publicHoliday_days').innerHTML = 'Public Holidays: ' + data.publicHoliday;
                //         }else{
                //             totalDaysInput.value = 1+daysDifference;
                //         }
                        
                //     }
                // }
                var available_days_data  = document.getElementById('available_days_data').value;
                if(data.available_days >0){
                    Swal.fire({
                        text: "Selected leave dates already used",
                        icon: "warning",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var difference = endDate - startDate;
                            var daysDifference = Math.ceil(difference / (1000 * 60 * 60 * 24));
                            
                            if (daysDifference === 0) {
                                var takendays =1;
                                totalDaysInput.value = takendays;
                               
                                if(takendays > available_days_data){
                                    Swal.fire({
                                        text: "Taken days are more than available",
                                        icon: "warning",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary",
                                        },
                                    });
                                }
                            } else {
                                if(data.publicHoliday >0){
                                    var takendays =1+daysDifference - data.publicHoliday;
                                    totalDaysInput.value = takendays;
                                    document.getElementById('publicHoliday_days').innerHTML = 'Public Holidays: ' + data.publicHoliday;
                                    if(takendays > available_days_data){
                                        Swal.fire({
                                            text: "Taken days are more than available",
                                            icon: "warning",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn btn-primary",
                                            },
                                        });
                                    }
                                }else{
                                    var takendays =1+daysDifference;
                                    totalDaysInput.value = takendays;
                                    
                                    if(takendays > available_days_data){
                                        Swal.fire({
                                            text: "Taken days are more than available",
                                            icon: "warning",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn btn-primary",
                                            },
                                        });
                                    }
                                }
                                
                            }
                        }
                    });
                }else{
                    var difference = endDate - startDate;
                    var daysDifference = Math.ceil(difference / (1000 * 60 * 60 * 24));
                    
                    if (daysDifference === 0) {
                        var takendays =1;
                        totalDaysInput.value = takendays;
                        if(takendays > available_days_data){
                            Swal.fire({
                                text: "Taken days are more than available",
                                icon: "warning",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            });
                        }
                    } else {
                        if(data.publicHoliday >0){
                            var takendays =1+daysDifference - data.publicHoliday;
                            totalDaysInput.value = takendays;
                            document.getElementById('publicHoliday_days').innerHTML = 'Public Holidays: ' + data.publicHoliday;
                            if(takendays > available_days_data){
                                    Swal.fire({
                                        text: "Taken days are more than available",
                                        icon: "warning",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary",
                                        },
                                    });
                                }
                        }else{
                            var takendays = 1+daysDifference;
                            totalDaysInput.value = takendays;
                            if(takendays > available_days_data){
                                    Swal.fire({
                                        text: "Taken days are more than available",
                                        icon: "warning",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary",
                                        },
                                    });
                                }
                        }
                        
                    }
                } 
            });
        }

        startDateInput.addEventListener('change', calculateDays);
        endDateInput.addEventListener('change', calculateDays);
    });


    document.getElementById('leaveType_id').addEventListener('change', function() {
        var leaveTypeId = this.value;
        var employee_id = document.getElementById('employee_id').value;
        //var availableDaysShow = document.getElementById('availableDaysShow');
        var selectElement = document.getElementById('leaveType_id');
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var leaveType = selectedOption.getAttribute("leave_Type");

        let data = {
            leaveTypeId: leaveTypeId,
            employee_id:employee_id,
            leaveType:leaveType,
            '_token': document.getElementsByName("_token")[0].value
        }
        const url = "{{ route('employees.get-available-days') }}";

        const response = fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(response => response.json()) // Parse JSON response
        .then(data => {
            if (data && data.available_days > 0) {
                document.getElementById('available_days').innerHTML = 'Available Days: ' + data.available_days;
                document.getElementById('available_days_data').value = data.available_days;
                document.getElementById('leave_type').value = leaveType;
                
            } else {
                document.getElementById('available_days').innerHTML = 'Available Days: ' +0;
                document.getElementById('available_days_data').value = 0;
                
            }
        })
    });
</script>