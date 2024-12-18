 <div class="card-body pt-9 pb-0">
     <!--begin::Details-->
     <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
         <!--begin: Pic-->
         <div class="me-7 mb-4">
             <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                 @if($userInfo->passport_photo)
                 <img src="{{ asset('storage/'.$userInfo->passport_photo) }}" alt="image" class="img-fluid rounded float-left" />
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
                         <div class="col-md-4 col-sm-12 b-r"> <strong>Student Number</strong>
                             <br>
                             <p class="text-muted">{{ optional($userInfo)->student_number }}</p>
                         </div>
                         <div class="col-md-4 col-sm-12 b-r"> <strong>Full Name</strong>
                             <br>
                             <p class="text-muted">{{ optional($userInfo->title)->title }} {{ optional($userInfo)->first_names }} {{ optional($userInfo)->surname }}</p>
                         </div>
                         <div class="col-md-4 col-sm-12 b-r"> <strong>Maiden Name</strong>
                             <br>
                             <p class="text-muted">{{ optional($userInfo)->maiden_name }}</p>
                         </div>
                         <div class="col-md-4 col-sm-12"> <strong>Gender</strong>
                             <br>
                             <p class="text-muted">{{ optional($userInfo->gender)->gender_type }}</p>
                         </div>

                         <div class="col-md-4 col-sm-12"> <strong>Birthdate</strong>
                             <br>
                             <p class="text-muted">{{ date('d M, Y',strtotime(optional($userInfo)->date_of_birth)) }}</p>
                         </div>

                         <div class="col-md-4 col-sm-12"> <strong>ID Number</strong>
                             <br>
                             <p class="text-muted">{{ optional($userInfo)->id_number }}</p>
                         </div>

                         <div class="col-md-4 col-sm-12 b-r"> <strong>Mobile Number</strong>
                             <br>
                             <p class="text-muted">{{ optional($userInfo)->mobile_number }}</p>
                         </div>
                         <div class="col-md-4 col-sm-12 b-r"> <strong>Email Address</strong>
                             <br>
                             <p class="text-muted">{{ optional($userInfo)->email_address }}</p>
                         </div>
                         <div class="col-md-4 col-sm-12"> <strong>Citizenship</strong>
                             <br>
                             <p class="text-muted">{{ optional($userInfo->studentType)->student_type }}</p>
                         </div>

                         <div class="col-md-4 col-sm-12 b-r"> <strong>Postal Address</strong>
                             <br>
                             <p class="text-muted">
                                 {{ optional($userInfo)->postal_address_line_1 }}<br>
                                 {{ optional($userInfo)->postal_address_line_2 }}<br>
                                 {{ optional($userInfo)->postal_address_line_3 }}
                             </p>
                         </div>

                         <div class="col-md-4 col-sm-12 b-r"> <strong>Residential Address</strong>
                             <br>
                             <p class="text-muted">
                                 {{ optional($userInfo)->residential_address_line_1 }}<br>
                                 {{ optional($userInfo)->residential_address_line_2 }}<br>
                                 {{ optional($userInfo)->residential_address_line_3 }}
                             </p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>