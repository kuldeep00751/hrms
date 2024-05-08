<x-base-layout>
    <div class="col-md-10 mx-auto">


        <div class="card mb-5">
            <div class="card-header">
                <div class="pull-left">
                    <a href="{{ route('user_infos.user_info.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Students </a>
                </div>
                <div class="pull-right">
                    <a href="{{ route('user_infos.user_info.edit', $userInfo->id) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-edit"></i> Update Profile </a>
                </div>
            </div>
            @include('pages.applications.user_info.nav')
        </div>

        <div class="card mb-5">
            <div class="card-header">
                <h6 class="fw-bolder m-0">Qualification Information</h6>
            </div>
            <div class="card-body pt-9 pb-0">
                <div class="table-responsive">

                    <table class="table table-hover" style="font-size: 12px; cursor:pointer">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                <th nowrap>Year</th>
                                <th nowrap>Qualification</th>
                                <th nowrap>Intake</th>
                                <th nowrap>Campus</th>
                                <th nowrap>Year Level</th>
                                <th nowrap>Registration Status</th>
                                <th nowrap>Promotion Status</th>
                                <th nowrap></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($registrations as $registration)
                            <tr>
                                <td nowrap>{{ $registration->academic_year }}</td>
                                <td nowrap>{{ $registration->qualification_name }}</td>
                                <td nowrap>{{ $registration->academic_intake }}</td>
                                <td nowrap>{{ $registration->campus_name }}</td>
                                <td nowrap>{{ $registration->year_level }}</td>
                                <td nowrap>{{ $registration->status }}</td>
                                <td nowrap>{{ $registration->promotion_status_description }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">
                                    <div class="alert alert-info">
                                        Student qualification registration information not found.
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header">
                <h6 class="fw-bolder m-0">Module Information</h6>
            </div>
            <div class="card-body pt-9 pb-0">
                <div class="table-responsive">

                    <table class="table table-hover" style="font-size: 12px; cursor:pointer">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                <th nowrap>Year</th>
                                <th nowrap>Module</th>
                                <th nowrap>Intake</th>
                                <th nowrap>Campus</th>
                                <th nowrap>Study Mode</th>
                                <th nowrap>Study Period</th>
                                <th nowrap>Exam Type</th>
                                <th nowrap>CA Mark</th>
                                <th nowrap>Exam Mark</th>
                                <th nowrap>Final Mark</th>
                                <th nowrap>Result Code</th>
                                <th nowrap>Result Description</th>
                                <th nowrap>Pass Fail</th>
                                <th nowrap>Cancel Date</th>
                                <th nowrap>Exemption Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @forelse($moduleRegistrations as $registration)

                            <tr>
                                <td nowrap>{{ $registration->academic_year }}</td>
                                <td nowrap>{{ $registration->module_name }}</td>
                                <td nowrap>{{ $registration->academic_intake }}</td>
                                <td nowrap>{{ $registration->campus_name }}</td>
                                <td nowrap>{{ $registration->study_mode }}</td>
                                <td nowrap>{{ $registration->study_period }}</td>
                                <td nowrap>{{ $registration->assessment_type }}</td>
                                <td nowrap>{{ $registration->ca_mark }}</td>
                                <td nowrap>{{ $registration->exam_mark }}</td>
                                <td nowrap>{{ $registration->final_mark }}</td>
                                <td nowrap>{{ $registration->result_code }}</td>
                                <td nowrap>{{ $registration->result_code_description }}</td>
                                <td nowrap>{{ $registration->pass_fail }}</td>
                                <td nowrap>{{ $registration->cancel_date }}</td>
                                <td nowrap>{{ $registration->exemption_date }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="14">
                                    <div class="alert alert-info">
                                        Student qualification registration information not found.
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-base-layout>