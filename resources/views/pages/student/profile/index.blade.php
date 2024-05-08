<x-base-layout>
    <div class="col-md-10 mx-auto">


        <div class="card mb-5">
            <div class="card-header">
                <div class="pull-left">
                    <a href="dashboard" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Dashboard </a>
                </div>
                <div class="pull-right">
                    <a href="{{ theme()->getPageUrl('student/update-biographical') }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-edit"></i> Update Profile </a>
                </div>
            </div>
            @include('pages.student.profile.nav')
        </div>

        <div class="card mb-5">
            <div class="card-header">
                <h6 class="fw-bolder m-0">Guardian Information</h6>
            </div>
            <div class="card-body pt-9 pb-0">
                @forelse($userInfo->nextOfKin as $key => $nextOfKin)
                <div class="row">
                    <div class="col-md-3 col-sm-12"> <strong>{{ $key + 1}}. Full Name</strong>
                        <br>
                        <p class="text-muted">{{ optional($nextOfKin)->nok_full_names }} (<strong>{{ optional($nextOfKin)->relationship->relationship }}</strong>)</p>
                    </div>
                    <div class="col-md-3 col-sm-12"> <strong>Contact Number</strong>
                        <br>
                        <p class="text-muted">{{ optional($nextOfKin)->nok_contact_number }}</p>
                    </div>
                    <div class="col-md-3 col-sm-12"> <strong>ID Number</strong>
                        <br>
                        <p class="text-muted">{{ optional($nextOfKin)->nok_id_number }}</p>
                    </div>
                    <div class="col-md-3 col-sm-12"> <strong>Address</strong>
                        <p class="text-muted">
                            {{ optional($nextOfKin)->nok_address_line1 }} <br>
                            {{ optional($nextOfKin)->nok_suburb }} <br>
                            {{ optional($nextOfKin)->nok_town }} <br>
                            {{ optional($nextOfKin->country)->name }} <br>
                        </p>
                    </div>
                </div>
                <div class="separator separator-dashed mx-5 my-5"></div>
                @empty
                <div class="alert alert-info">
                    Guardian information has not been captured
                </div>
                @endforelse
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header">
                <h6 class="fw-bolder m-0">Secondary School Information</h6>
            </div>
            <div class="card-body pt-9 pb-0">

                <div class="row">

                    <div class="col-md-3 col-sm-12"> <strong>Last School Attended</strong>
                        <br>
                        <p class="text-muted">{{ $userInfo->last_school_attended }}</p>
                    </div>
                    <div class="col-md-3 col-sm-12"> <strong>Education System</strong>
                        <br>
                        <p class="text-muted">{{ optional($userInfo->educationSystem)->system_name }}</p>
                    </div>
                    <div class="col-md-3 col-sm-12"> <strong>Highest Grade</strong>
                        <br>
                        <p class="text-muted">{{ $userInfo->highest_grade }}</p>
                    </div>
                    <div class="col-md-3 col-sm-12"> <strong>Year Completed (YYYY-MM)</strong>
                        <br>
                        <p class="text-muted">{{ $userInfo->highest_grade }}</p>
                    </div>
                </div>
                <div class="row mb-6">
                    <div class="col-lg-12">
                        <div class="table-responsive">

                            <table class="table table-row-dashed table-bordered border table-rounded p-5">
                                <thead>
                                    <tr class="text-start fw-bold text-uppercas ">
                                        <th>Subject</th>
                                        <th>Level</th>
                                        <th class="text-center">Final Result</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($userInfo->schoolSubjects as $schoolSubject)
                                    <tr>
                                        <td style="width: 40%;">
                                            {{ optional($schoolSubject->subject)->subject_name}}
                                        </td>
                                        <td style="width: 30%;">
                                            {{ $schoolSubject->matric_type}}
                                        </td>

                                        <td style="width: 20%;" class="text-center">
                                            {{ $schoolSubject->final_term_result}} ({{ $schoolSubject->final_term_points}})
                                        </td>
                                    </tr>
                                    @empty
                                    <div class="alert alert-info">
                                        Matric subjects not found
                                    </div>
                                    @endforelse

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" class="text-center"><span class="fw-bold"><strong>Total Points</strong></span></td>

                                        <td class="text-center fw-bold">
                                            <span class="fw-bold" id="final_term_total_points">
                                                {{ $userInfo->schoolSubjects->sum('final_term_points') }}
                                            </span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                    <!--end::Col-->
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header">
                <h6 class="fw-bolder m-0">Previous Qualifications</h6>
            </div>
            <div class="card-body pt-9 pb-0">
                @forelse($userInfo->previousQualification as $key => $previousQualification)
                <div class="row">
                    <div class="col-md-3 col-sm-12"> <strong>{{ $key + 1}}. Institution</strong>
                        <br>
                        <p class="text-muted">{{ optional($previousQualification)->institution }} (<strong>{{ optional($nextOfKin)->relationship->relationship }}</strong>)</p>
                    </div>
                    <div class="col-md-3 col-sm-12"> <strong>Student Number</strong>
                        <br>
                        <p class="text-muted">{{ optional($previousQualification)->student_number }}</p>
                    </div>
                    <div class="col-md-3 col-sm-12"> <strong>Qualification</strong>
                        <br>
                        <p class="text-muted">{{ optional($previousQualification)->qualification_name }}</p>
                    </div>
                    <div class="col-md-3 col-sm-12"> <strong>Awarded (Y/N)</strong>
                        <br>
                        <p class="text-muted">{{ $previousQualification->awarded_yn == 1 ? 'Yes' : 'No' }}</p>
                    </div>
                    <div class="col-md-3 col-sm-12"> <strong>When</strong>
                        <p class="text-muted">
                            {{ optional($previousQualification)->from_date }} - {{ optional($previousQualification)->to_date }}
                        </p>
                    </div>

                    <div class="col-md-12 col-sm-12">
                        @if($previousQualification->document_path)
                        <p class="text-muted">

                            <a href="/previous-qualifications/download/{{$previousQualification->id}}/{{ $userInfo->name }}" class="btn btn-sm btn-light btn-active-light-primary">
                                <i class="fa-solid fa-download"></i> Download Document
                            </a>

                        </p>
                        @endif
                    </div>

                </div>
                <div class="separator separator-dashed mx-5 my-5"></div>
                @empty
                <div class="alert alert-info">
                    Student does not have any previous qualifications
                </div>
                @endforelse
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header">
                <h6 class="fw-bolder m-0">Employment Details</h6>
            </div>
            <div class="card-body pt-9 pb-0">
                @if($userInfo->employment)
                @php
                $employment = $userInfo->employment;
                @endphp
                <div class="row">
                    <div class="col-md-6 col-sm-12"> <strong>Company Name</strong>
                        <br>
                        <p class="text-muted">{{ optional($employment)->company_name }} (<strong>{{ optional($nextOfKin)->relationship->relationship }}</strong>)</p>
                    </div>
                    <div class="col-md-6 col-sm-12"> <strong>Position</strong>
                        <br>
                        <p class="text-muted">{{ optional($employment)->position }}</p>
                    </div>
                    <div class="col-md-6 col-sm-12"> <strong>Department</strong>
                        <br>
                        <p class="text-muted">{{ optional($employment)->department }}</p>
                    </div>
                    <div class="col-md-6 col-sm-12"> <strong>Company Address</strong>
                        <br>
                        <p class="text-muted">{{ $employment->company_address }}</p>
                    </div>
                    <div class="col-md-6 col-sm-12"> <strong>Work Contact Number</strong>
                        <p class="text-muted">
                            {{ optional($employment)->work_contact_number }}
                        </p>
                    </div>

                    <div class="col-md-3 col-sm-12"> <strong>Work Email</strong>
                        <p class="text-muted">
                            {{ optional($employment)->work_email }}
                        </p>
                    </div>
                </div>
                @else
                <div class="alert alert-info">
                    No emploment details found
                </div>
                @endif


            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header">
                <h6 class="fw-bolder m-0">Health Questionnaire</h6>
            </div>
            <div class="card-body pt-9 pb-0">
                <div class="row">
                    <div class="col-md-12 col-sm-12"> <strong>Do you suffer from any chronic illness?</strong>
                        <br>
                        <p class="text-muted">
                            @if($userInfo->healthQuestionnaire)
                            <strong>{{ optional($userInfo)->healthQuestionnaire->chronic_illness_description }}</strong>
                            @else
                            No
                            @endif
                        </p>
                    </div>
                    <div class="col-md-12 col-sm-12"> <strong>Do you have any disability?</strong>
                        <br>
                        <p class="text-muted">
                            @if($userInfo->healthQuestionnaire)
                            <strong>{{ optional($userInfo)->healthQuestionnaire->disability_description }}</strong>
                            @else
                            No
                            @endif
                        </p>
                    </div>
                </div>

            </div>
            <div class="separator separator-dashed mx-5 my-5"></div>
            <div class="d-flex justify-content-end p-5">
                <a href="{{ theme()->getPageUrl('student/update-biographical') }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-edit"></i> {{ __('Update Profile') }}</a>
            </div>
        </div>



    </div>
</x-base-layout>