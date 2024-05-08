<x-base-layout>
    <!--begin::Basic info-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('Update application') }}</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Card body-->
        <form method="POST" action="{{ route('application.update', $application->id) }}" accept-charset="UTF-8" id="update_application_form" name="update_application_form" class="form-horizontal">
            <div class="card-body border-top p-9">
                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif


                {{ csrf_field() }}
                
                @include ('pages.student.applications.form', [
                'qualifications' => $qualifications,
                'title' => 'Update application',
                'application' => $application
                ])


            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9 bg-white">
                <a href="{{ route('application.index') }}" class="btn btn-white btn-active-light-primary me-2">{{ __('Cancel') }}</a>

                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                    {{ __('Save Changes') }}
                </button>
            </div>
        </form>
        <!--end::Actions-->
    </div>

</x-base-layout>