<div class="stepper stepper-pills stepper-column d-flex flex-column flex-lg-row" id="kt_stepper_example_vertical">
    <!--begin::Aside-->
    <div class="d-flex flex-row-auto w-100 w-lg-300px">  
        @include('hr.employees._stepper-header')
    </div>

    <!--begin::Content-->
    <div class="flex-row-fluid">
        <!--begin::Form-->
        <form id="kt_account_profile_details_form" class="form" method="POST" action="{{ route('employees.employee.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ old('id', $employee->id ?? '') }}">
            <!--begin::Group-->
            <div class="mb-5">

                <div class="flex-column current" data-kt-stepper-element="content" id="current-step-1">
                   @include('hr.employees.sections._profile-details')
                </div>
                <!--begin::Step 1-->
                <div class="flex-column" data-kt-stepper-element="content" id="current-step-2">
                    @include('hr.employees.sections._contract')
                </div>
                <!--begin::Step 1-->

                <!--begin::Step 1-->
                <div class="flex-column" data-kt-stepper-element="content" id="current-step-3">
                    @include('hr.employees.sections._residential')
                </div>
                <!--begin::Step 1-->

                <!--begin::Step 1-->
                <div class="flex-column" data-kt-stepper-element="content" id="current-step-4">
                    @include('hr.employees.sections._employment')
                </div>
                <!--begin::Step 1-->
                <!--begin::Step 1-->
                <div class="flex-column" data-kt-stepper-element="content" id="current-step-5">
                    @include('hr.employees.sections._documents')
                </div>
                <!--begin::Step 1-->
                <!--begin::Step 1-->
                
                <!--begin::Step 1-->
                <!--begin::Step 1-->
                <div class="flex-column" data-kt-stepper-element="content" id="current-step-6">
                @include('pages/account/settings/_confirmation')
                </div>

                <!-- <div class="flex-column" data-kt-stepper-element="content" id="current-step-7">
                    
                </div>

                <div class="flex-column" data-kt-stepper-element="content" id="current-step-8">
                    
                </div>

                <div class="flex-column" data-kt-stepper-element="content" id="current-step-9">
                    
                </div> -->

            </div>
            <!--end::Group-->

            <!--begin::Actions-->
            <div class="d-flex flex-stack">
                <!--begin::Wrapper-->
                <div class="me-2">
                    <button type="button" class="btn btn-light btn-active-light-primary" data-kt-stepper-action="previous">
                        <i class="fa-solid fa-chevron-left"></i> Previous
                    </button>
                </div>
                <!--end::Wrapper-->

                <!--begin::Wrapper-->
                <div>
                    <!-- <button type="button" class="btn btn-primary" data-kt-stepper-action="submit">
                        <span class="indicator-label">
                            Submit
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button> -->

                    <button type="button" class="btn btn-primary" data-kt-stepper-action="next">
                        Next <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
</div>
@section('scripts')
    <script src="https://hrms.ciws.in/demo1/js/custom/account/settings/employee-details.js"></script>    
    <script src="https://hrms.ciws.in/demo1/js/custom/account/settings/emp-stepper.js"></script>
@endsection