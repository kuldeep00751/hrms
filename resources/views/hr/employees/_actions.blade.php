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
            <a href="{{ route('employees.employee.show', $employee->id) }}" class="menu-link px-3">Show Profile</a>
        </div>
 
        <div class="menu-item px-3">
            <a href="{{ route('employees.employee.edit', $employee->id) }}" class="menu-link px-3">Update Profile</a>
        </div>

        <div class="menu-item px-3">
            <a href="{{ route('employee.edit', $employee->employee_id) }}" class="menu-link px-3">Permission</a>
        </div>
        <div class="menu-item px-3">
            <a href="{{ route('employees.employee.documents', $employee->id) }}" class="menu-link px-3">Documents</a>
        </div>
        <div class="menu-item px-3">
            <a href="#" class="menu-link px-3">Payroll / Payslip</a>
        </div>
        <div class="menu-item px-3">
            <a href="{{ route('leave-mananagements.leave-mananagement.employee',$employee->employee_id)}}" class="menu-link px-3">Leave Management</a>
        </div>
        <div class="menu-item px-3">
            <a href="#" class="menu-link px-3">Performance Management</a>
        </div>

        <!-- <div class="menu-item px-3">
            <a href="#" class="menu-link px-3">Applications</a>
        </div> -->

    </div>
</td>