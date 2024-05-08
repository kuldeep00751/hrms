<x-base-layout>
    {{ theme()->getView('pages/account/_navbar', array('class' => 'mb-5 mb-xl-10')) }}

   
    <div class="row gy-10 gx-xl-10">
        <!--begin::Col-->
        <div class="col-xl-12">
            {{ theme()->getView('pages/account/overview/_school-information', array('info' => auth()->user()->info)) }}
        </div>
        <!--end::Col-->
    </div>
    <!--begin::Row-->
    <div class="row gy-10 gx-xl-10">
        <!--begin::Col-->
        <div class="col-xl-12">
            {{ theme()->getView('pages/account/overview/_nok', array('info' => auth()->user()->info)) }}
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row gy-10 gx-xl-10">
        <!--begin::Col-->
        <div class="col-xl-12">
            {{ theme()->getView('pages/account/overview/_previous-qualifications', array('info' => auth()->user()->info)) }}
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <div class="row gy-10 gx-xl-10">
        <!--begin::Col-->
        <div class="col-xl-12">
            {{ theme()->getView('pages/account/overview/_employment', array('info' => auth()->user()->info)) }}
        </div>
        <!--end::Col-->
    </div>

    <div class="row gy-10 gx-xl-10">
        <!--begin::Col-->
        <div class="col-xl-12">
            {{ theme()->getView('pages/account/overview/_health-questionnaire', array('info' => auth()->user()->info)) }}
        </div>
        <!--end::Col-->
    </div>
</x-base-layout>