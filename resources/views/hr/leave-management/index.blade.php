<x-base-layout>
    <style>
        div.dataTables_wrapper div.dataTables_filter {
            padding: 1rem 0;
        }
        div.dataTables_filter {
            text-align: right;
        }
        div.dataTables_wrapper div.dataTables_filter label {
            font-weight: normal;
            white-space: nowrap;
            text-align: left;
        }
        div.dataTables_filter input {
            margin-left: 0.5em;
            display: inline-block;
            width: auto;
        }
    </style>
    <div class="col-md-12">

        <div class="card">
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <h6>List of Leave Application</h6>
                    </div>

                    <div class="pull-right" role="group">
                        <a href="{{ route('leave-mananagements.leave-mananagement.create') }}" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-plus"></i> Add New
                        </a>
                    </div>
                </div>

                @if(count($leaveManages) == 0)
                <div class="card-body text-center">
                    <h4>No Leave application Available.</h4>
                </div>
                @else
                <div class="card-body">
                    @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <h6 class="text-success">
                            <i class="fa-solid fa-circle-check text-success"></i>
                            {!! session('success_message') !!}
                        </h6>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <div id="employees-table_filter" class="dataTables_filter">
                            <label>Search:<input type="search" id="searchInput" class="form-control form-control-solid w-250px" placeholder=""></label>
                        </div>
                        <table class="table" id="kt_datatable_example" style="font-size: 12px; cursor: pointer;">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Employee</th>
                                    <th>Leave Type</th>
                                    <th>Applied On</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Total Days</th>
                                    <th>Leave Reason</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leaveManages as $leaveManage)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex justify-content-start flex-column">
                                                {{ $leaveManage->postedBy->first_name }}  {{ $leaveManage->postedBy->last_name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                    {{ ($leaveManage->leave_type =='leaveType')?$leaveManage->leaveType->name:(($leaveManage->leave_type =='AccumulativeType')?'accumulative Leave':'') }}
                                    </td>
                                    <td>{{ date('d, M Y', strtotime($leaveManage->created_at)) }}</td>
                                    <td>{{ date('d, M Y', strtotime($leaveManage->start_date)) }}</td>
                                    <td>{{ date('d, M Y', strtotime($leaveManage->end_date)) }}</td>
                                    <td>{{ $leaveManage->total_days }}</td>
                                    <td>{{ $leaveManage->leave_reason }}</td>
                                    <td>
                                    @if($leaveManage->status == 'Pending')
                                        <div class="badge bg-warning p-2 px-3 rounded status-badge5">{{ $leaveManage->status }}</div>
                                    @elseif($leaveManage->status == 'Rejected')
                                        <div class="badge bg-danger p-2 px-3 rounded status-badge5">{{ $leaveManage->status }}</div>
                                    @elseif($leaveManage->status == 'Approved')
                                        <div class="badge bg-success p-2 px-3 rounded status-badge5">{{ $leaveManage->status }}</div>
                                    @else
                                        <div class=""></div>
                                    @endif
                                        
                                    </td>

                                    <td>
                                        <!--begin::Action menu-->
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen052.svg-->
                                            <i class="bi bi-three-dots fs-3"></i> <!--end::Svg Icon-->
                                        </a>

                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase"><strong>Options</strong></div>
                                            </div>
                                            
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('leave-mananagements.leave-mananagement.show', $leaveManage->id ) }}" class="menu-link px-3">Manage Leave</a>
                                                </div>
                                            
                                            <div class="menu-item px-3">
                                            <a href="{{ route('leave-mananagements.leave-mananagement.edit', $leaveManage->id) }}" class="menu-link px-3">Update Leave</a>
                                            </div>

                                            <div class="menu-item px-3">
                                            <a href="{{ route('leave-mananagements.leave-mananagement.destroy', $leaveManage->id) }}" class="menu-link px-3">Delete Leave</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody> 
                        </table>

                    </div>
                    {{ $leaveManages->links('pagination::bootstrap-5') }}
                </div>
                @endif

            </div>
        </div>
    </div>
    <script>
    document.getElementById('searchInput').addEventListener('input', function() {
        var filter = this.value.toLowerCase();
        var rows = document.getElementById('kt_datatable_example').getElementsByTagName('tr');
        for (var i = 0; i < rows.length; i++) {
            var name = rows[i].getElementsByTagName('td')[0];
            var email = rows[i].getElementsByTagName('td')[1];
            if (name || email) {
                if (name.innerHTML.toLowerCase().indexOf(filter) > -1 || email.innerHTML.toLowerCase().indexOf(filter) > -1) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }       
        }
    });
</script>
</x-base-layout>