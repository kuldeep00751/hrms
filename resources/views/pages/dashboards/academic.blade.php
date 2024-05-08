<x-base-layout>

    <!--begin::Row-->
    <div class="row gy-5 g-xl-8">
        <!--begin::Col-->
        <div class="col-xxl-6">

            {{ theme()->getView('partials/widgets/mixed/_widget-2', array('class' => 'card-xxl-stretch', 'chartColor' => 'danger', 'chartHeight' => '200px', 'applicationCategories' => $applicationCategories, 'applicationsPerMonth' => $applicationsPerMonth, 'academicTallies' => $academicTallies)) }}
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xxl-6">
            {{ theme()->getView('partials/widgets/mixed/_widget-7', array('class' => 'card-xxl-stretch-50 mb-5 mb-xl-8', 'chartColor' => 'primary', 'chartHeight' => '150px', 'academicTallies' => $academicTallies, 'enrolmentCampusStatistics' => $enrolmentCampusStatistics)) }}

            {{ theme()->getView('partials/widgets/mixed/_widget-10', array('class' => 'card-xxl-stretch-50 mb-5 mb-xl-8', 'chartColor' => 'primary', 'chartHeight' => '175px', 'enrolmentCampusStatistics' => $enrolmentCampusStatistics)) }}
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Row-->
    <div class="row gy-5 gx-xl-8">
        <div class="col-xxl-6">
            {{ theme()->getView('partials/widgets/lists/_widget-3', array('class' => 'card-xxl-stretch mb-xl-3', 'registrationsByQualification' => $registrationsByQualification)) }}
        </div>

        <div class="col-xl-6">
            {{ theme()->getView('partials/widgets/lists/_widget-6', array('class' => 'card-xl-stretch mb-xl-8', 'registrationVsAdmission' => $registrationVsAdmission)) }}
        </div>
    </div>
    <div class="row gy-5 gx-xl-8">
        <div class="col-xl-12">
            {{ theme()->getView('partials/widgets/lists/_qualifications', array('class' => 'card-xl-stretch mb-xl-8', 'registrationsByQualification' => $registrationsByQualification)) }}
        </div>
    </div>

</x-base-layout>