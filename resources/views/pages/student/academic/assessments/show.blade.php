<x-base-layout>
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-bottom border-gray-200">
            <div class="pull-left">
                <a href="{{ route('academic.assessments') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> My Modules</a>
            </div>
            <!--begin::Title-->
            <div class="card-title">
                <h3 class="fw-bold m-0">{{ $moduleRegistration->module->module_name}} ({{ $moduleRegistration->module->module_code}})</h3>
            </div>
            <!--end::Title-->
        </div>
        <!--end::Card header-->
        <div class="card-body">
            <div class="table-responsive">
                <h6><strong>Module Info</strong></h6>
                <table class="table table-row-dashed table-rounded border">
                    <tr>
                        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered" style="width:200px;">{{ __('Academic Year') }}</th>
                        <td>{{ $moduleRegistration->academicYear->name }} </td>
                    </tr>
                    <tr>
                        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered" style="width:200px;">{{ __('Academic Intake') }}</th>
                        <td>{{ $moduleRegistration->academicIntake->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered" style="width:200px;">{{ __('Campus') }}</th>
                        <td>{{ $moduleRegistration->campus->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Module Name') }}</th>
                        <td>{{ $moduleRegistration->module->module_name }}</td>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Module Code') }}</th>
                        <td>{{ $moduleRegistration->module->module_code }}</td>
                    </tr>
                    <tr>
                        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Study Mode') }}</th>
                        <td>{{ $moduleRegistration->studyMode->study_mode }}</td>
                    </tr>
                </table>
            </div>
            <div class="separator separator-dashed mx-5 my-5"></div>
            <div class="table-responsive">
                <table class="table table-row-dashed table-rounded border">
                    @foreach($assessmentMarks as $assessment)
                    
                    <tr>
                        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered" style="width:200px;">{{ optional($assessment->markType)->assessment_description }}</th>
                        <td>
                            @if($suppressCa)
                            <i>Suppressed</i>
                            @else
                            {{ $assessment->mark }}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered" style="width:200px;">{{ __('CA mark') }}</th>
                        <td>
                            @if($suppressCa)
                            <i>Suppressed</i>
                            @else
                            {{ optional($studentCa)->ca_mark }}
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</x-base-layout>