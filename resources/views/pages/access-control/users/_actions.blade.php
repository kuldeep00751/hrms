 <td>
     <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
         <!--begin::Svg Icon | path: icons/duotune/general/gen052.svg-->
         <i class="bi bi-three-dots fs-3"></i> <!--end::Svg Icon-->
     </a>

     <!--begin::Menu-->
     <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
         <div class="menu-item px-3">
             <a href="{{ route('users.edit', $user->id ) }}" class="menu-link px-3">Edit</a>
         </div>

         <div class="menu-item px-3">
             <a href="{{ route('users.access-control', $user->id ) }}" class="menu-link px-3">Access Control</a>
         </div>

     </div>
 </td>