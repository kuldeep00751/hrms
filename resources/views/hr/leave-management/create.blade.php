<x-base-layout>
    <div class="col-md-8 mx-auto">
        <div class="card">

            <div class="card-header">
                <div class="pull-left">
                    <a href="{{ route('leave-mananagements.leave-mananagement.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Leaves</a>
                </div>
                <span class="pull-right">
                    <h4 class="mt-5 mb-5">Create New Leave</h4>
                </span>
            </div>
            <form method="POST" id="leaveManagementForm" action="{{ route('leave-mananagements.leave-mananagement.store') }}" accept-charset="UTF-8" class="form-horizontal" id="leave-manage-form" enctype="multipart/form-data">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

 
                    {{ csrf_field() }}
                    @include ('hr.leave-management.form', [
                    'leaveManage' => null,
                    ])

                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" id="submitButton" value="Save">

                        <a href="{{ route('leave-mananagements.leave-mananagement.index') }}">
                            Cancel
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('leaveManagementForm').addEventListener('submit', function(event) {
                event.preventDefault();
                
                var available_days = parseInt(document.getElementById('available_days_data').value);
                var totalDays = parseInt(document.getElementById('total_days').value);
                
                if (totalDays > available_days) {
                    Swal.fire({
                        text: "Available leave days more than taken days.",
                        icon: "warning",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                    
                }else{
                    this.submit();
                }
            });
        });
    </script>
</x-base-layout>