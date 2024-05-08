@php
$nav = array(
array('title' => 'Overview', 'view' => 'account/overview'),
array('title' => 'Settings', 'view' => 'account/settings'),
// array('title' => 'Security', 'view' => ''),
);
@endphp

<!--begin::Navbar-->
<div class="card mb-1">
    <div class="card-body pt-9 pb-0">
        <!--begin::Details-->
        <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
            <!--begin: Pic-->
            <div class="me-7 mb-4">
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    <img src="{{ asset('storage/'.auth()->user()->info->passport_photo) }}" alt="image" />
                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"></div>
                </div>
            </div>
            <!--end::Pic-->

            <!--begin::Info-->
            <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <!--begin::User-->
                    <div class="d-flex flex-column">
                        <!--begin::Name-->
                        <div class="d-flex align-items-center mb-2">
                            <span class="text-gray-800 text-hover-primary fs-2 fw-bolder me-1">{{ auth()->user()->name }}</span>

                            <span class="btn btn-sm btn-light-success fw-bolder ms-2 fs-8 py-1 px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">{{ __('Provisionally Admitted') }}</span>
                        </div>
                        <!--end::Name-->

                        <!--begin::Info-->
                        <div class="d-flex flex-column flex-wrap fw-bold mb-4 pe-2">
                            <span class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                {!! theme()->getSvgIcon("icons/duotune/communication/com014.svg", "svg-icon-4 me-1") !!}
                                {{ optional(auth()->user()->info->genderType)->gender_type }}
                            </span>
                            <span class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                {!! theme()->getSvgIcon("icons/duotune/general/gen014.svg", "svg-icon-4 me-1") !!}
                                {{ auth()->user()->info->date_of_birth }}
                            </span>
                            <span class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                {!! theme()->getSvgIcon("icons/duotune/communication/com006.svg", "svg-icon-4 me-1") !!}
                                {{ auth()->user()->info->id_number }}
                            </span>
                            <span class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                {!! theme()->getSvgIcon("icons/duotune/communication/com011.svg", "svg-icon-4 me-1") !!}
                                {{ auth()->user()->email }}
                            </span>
                            <span class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                {!! theme()->getSvgIcon("icons/duotune/communication/com005.svg", "svg-icon-4 me-1") !!}
                                {{ auth()->user()->info->mobile_number }}
                            </span>
                            <span class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                {!! theme()->getSvgIcon("icons/duotune/maps/map004.svg", "svg-icon-4 me-1") !!}
                                {{ auth()->user()->info->citizenship_status }}
                            </span>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::User-->

                    <!--begin::Actions-->
                    <div class="d-flex my-4">
                        <a href="{{ theme()->getPageUrl('student/update-biographical') }}" class="btn btn-sm btn-primary align-self-center">{{ __('Edit Profile') }}</a>
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Title-->
            </div>
            <!--end::Info-->
        </div>
        <!--end::Details-->

        <!--begin::Navs-->
        <!-- <div class="d-flex overflow-auto h-55px">
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                @foreach($nav as $each)
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ theme()->getPagePath() === $each['view'] ? 'active' : '' }}" href="{{ $each['view'] ? theme()->getPageUrl($each['view']) : '#' }}">
                        {{ $each['title'] }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div> -->
        <!--begin::Navs-->
    </div>
</div>
<!--end::Navbar-->