<div class="card-body pt-9 pb-0">
     <!--begin::Details-->
     <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
         <!--begin: Pic-->
         <div class="me-7 mb-4">
             <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                 @if($employees->passport_photo)
                 <img src="{{ asset('profile_images/'.$employees->passport_photo) }}" alt="image" class="img-fluid rounded float-left" />
                 <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border-white h-20px w-20px"></div>
                 @else
                 <img src="{{ asset('assets/media/avatars/blank.png') }}" alt="image" />
                 <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border-white h-20px w-20px"></div>
                 @endif
             </div>
         </div>
         <!--end::Pic-->

         <!--begin::Info-->
         <div class="flex-grow-1">
             <!--begin::Title-->
             <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                 <!--begin::User-->
                 <div class="d-flex flex-column">

                     <div class="row">
                         <div class="col-md-4 col-sm-12 b-r"> <strong>Employee Number</strong>
                             <br>
                             <p class="text-muted">{{ optional($employees)->employee_number }}</p>
                         </div>
                         <div class="col-md-4 col-sm-12 b-r"> <strong>Full Name</strong>
                             <br>
                             <p class="text-muted">{{ optional($employees->title)->title }} {{ optional($employees)->first_names }} {{ optional($employees)->surname }}</p>
                         </div>
                         <div class="col-md-4 col-sm-12 b-r"> <strong>Maiden Name</strong>
                             <br>
                             <p class="text-muted">{{ optional($employees)->maiden_name }}</p>
                         </div>
                         <div class="col-md-4 col-sm-12"> <strong>Gender</strong>
                             <br>
                             <p class="text-muted">{{ optional($employees->gender)->gender_type }}</p>
                         </div>

                         <div class="col-md-4 col-sm-12"> <strong>Birthdate</strong>
                             <br>
                             <p class="text-muted">{{ date('d M, Y',strtotime(optional($employees)->date_of_birth)) }}</p>
                         </div>
                         <div class="col-md-4 col-sm-12 b-r"> <strong>Marital Status</strong>
                             <br>
                             <p class="text-muted">{{ optional($employees->maritalStatus)->marital_status }}</p>
                         </div>
                         <div class="col-md-4 col-sm-12 b-r"> <strong>Email Address</strong>
                             <br>
                             <p class="text-muted">{{ optional($employees)->email_address }}</p>
                         </div>
                         
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="d-flex overflow-auto h-55px">
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
             <li class="nav-item">
                 <a class="nav-link text-active-primary me-6 {{ ($section === 'show') ? 'active':'' }}" href="{{ route('employees.employee.show', $employees->id) }}">
                     Employee Profile
                 </a>
             </li>

             <!-- <li class="nav-item"> -->
                 <!-- <a class="nav-link text-active-primary me-6 {{ ($section === 'registration') ? 'active':'' }}" href="{{ route('employees.employee.registration', $employees->id) }}">
                     Registration Information
                 </a> -->
                 <!-- <a class="nav-link text-active-primary me-6 {{ ($section === 'registration') ? 'active':'' }}" href="#">
                 Employment Information
                 </a>
             </li> -->

             <li class="nav-item">
                 <a class="nav-link text-active-primary me-6 {{ ($section === 'account') ? 'active':'' }}" href="{{ route('employees.employee.account', $employees->id) }}">
                     Account
                 </a>
             </li>
         </ul>
    </div>
 </div>