<x-base-layout>
    <div class="col-md-12">

        <div class="card">
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <a href="{{ route('leave-manages.leave-manage.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Leave</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('employee_id') ? 'has-error' : '' }}">
                                <label for="employee_id" class="control-label"><strong>Employee Name: </strong></label>

                                <span>{{ $leaveManage->postedBy->first_name }} {{ $leaveManage->postedBy->last_name }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('leaveType_id') ? 'has-error' : '' }}">
                                <label for="leaveType_id" class="control-label"><strong>Leave Type: </strong></label>
                                {{ ($leaveManage->leave_type =='leaveType')?$leaveManage->leaveType->name:(($leaveManage->leave_type =='AccumulativeType')?'accumulative Leave':'') }}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                                <label for="start_date" class="control-label"><strong>Start Date: </strong></label>
                                {{ date('d, M Y', strtotime($leaveManage->start_date)) }}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                                <label for="end_date" class="control-label"><strong>End Date: </strong></label>
                                {{ date('d, M Y', strtotime($leaveManage->end_date)) }}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('leave_reason') ? 'has-error' : '' }}">
                                <label for="leave_reason" class="control-label"><strong>Leave Reason: </strong></label>
                                <p>{{ old('leave_reason', optional($leaveManage)->leave_reason) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                <label for="status" class="control-label"><strong>Leave Status: </strong></label>
                                {{ $leaveManage->status }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('attachments') ? 'has-error' : '' }}">
                                <label for="attachments" class="control-label"><strong>Attachments: </strong></label>
                                <table class="table">
                                    @forelse($leaveManage->attachments as $attachment)
                                    <tr>
                                        <td>{{$attachment->document_name }}</td>
                                        <td>
                                        <a class="me-5 btn-outline-primary" href="#" onclick="openDocument({{$attachment->id}}, '{{$attachment->document_name}}')">
                                                <i class="fas fa-eye text-primary fs-4"></i>
                                            </a>
                                            <a href="{{ route('leave-manages.leave-manage.download', $attachment->id) }}">
                                                <i class="fa-solid fa-download text-primary"></i>
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
                    @if($leaveManage->reason_leave_approval !='' || $leaveManage->reason_leave_approval !=null )
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                <label for="reason_leave_approval" class="control-label"><strong>Reason For Leave Approval / Rejection: </strong></label>
                                {{ $leaveManage->reason_leave_approval }}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.approve-btn, .reject-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    let modelId = this.dataset.id;
                    var reason_leave_approval = document.getElementById('reason_leave_approval').value;
                    let active = this.classList.contains('approve-btn') ? 'Approved' : 'Rejected';
                     
                    //  if (reason_leave_approval.trim() === '') {
                    //     Swal.fire({
                    //         icon: 'warning',
                    //         title: 'Reason For Leave Approval',
                    //         text: 'Reason For Leave Approval is required!',
                    //         confirmButtonText: 'OK'
                    //     });
                    //     return false;
                    // }
                    let data = {
                        id: modelId,
                        active: active,
                        reason_leave_approval:reason_leave_approval,
                        '_token': document.getElementsByName("_token")[0].value
                    };

                    const url = "{{ route('employees.update-status') }}";

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data),
                    }).then(data => {
                        // Display success message using SweetAlert
                        Swal.fire({
                            text: "Leave status update successfully!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function (result) {
                            window.location.href = "{{ route('leave-manages.leave-manage.index') }}";
                        });
                    })
                    .catch(error => {
                        // Handle error
                        console.error('There was a problem with your fetch operation:', error);
                    });
                });
            });
        });
        function openDocument(attachmentId, attachmentName) {
            var width = "1000px"; // Get the screen width

            let params = `width=${width},height=800px,left=100,top=100`;

            window.open(`/leave-manages/display/${attachmentId}`, `${attachmentName}`, params);
        };
    </script>
</x-base-layout>