<x-base-layout>
    <!--begin::Basic info-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="pull-left">
                <a href="{{ route('user_infos.user_info.applications', $info->id) }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Student Applications </a>
            </div>
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('Create new application') }}</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Card body-->
        <div class="card-body">
            @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                {{ $error }}<br>
                @endforeach
            </ul>
            @endif

            <form method="POST" action="{{ route('user_infos.user_info.store-applications', $info->id) }}" accept-charset="UTF-8" id="create_application_form" name="create_application_form" class="form-horizontal">
                <div class="card-body border-top p-9">

                    {{ csrf_field() }}
                    @include ('pages.applications.user_info.application-form', [
                    'qualifications' => $qualifications,
                    'title' => 'Create new application',
                    'application' => null,
                    'studyModes' => [],
                    'campuses' => [],
                    ])


                </div>
                <!--end::Card body-->

                <!--begin::Actions-->
                <div class="card-footer d-flex justify-content-end py-6 px-9 bg-white">
                    <a href="{{ route('user_infos.user_info.applications', $info->id) }}" class="btn btn-white btn-active-light-primary me-2">{{ __('Cancel') }}</a>

                    <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                        {{ __('Save Changes') }}
                    </button>
                </div>
            </form>
        </div>
        <!--end::Actions-->
    </div>

</x-base-layout>