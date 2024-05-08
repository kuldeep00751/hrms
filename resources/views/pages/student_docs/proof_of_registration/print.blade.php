<div id="section-to-print" onload="window.onload = function() { window.print(); }">
    <table style="width: 100%;">
        <tr>
            <td style="width: 80%">
                <!--begin::Text-->
                <div class="text-sm-end fw-semibold fs-4 text-muted mt-7">
                    <div style="font-family: monospace;">
                        <strong>{{ $lov->where('label', 'COMPANY_NAME')->first()->value }}</strong>
                    </div>
                    <div style="font-family: monospace;">
                        {{ optional($lov->where('label', 'COMPANY_ADDRESS_1')->first())->value }} <br>
                        {{ optional($lov->where('label', 'COMPANY_ADDRESS_2')->first())->value }} <br>
                        {{ optional($lov->where('label', 'COMPANY_ADDRESS_3')->first())->value }} <br>
                        <strong>E: </strong>{{ optional($lov->where('label', 'COMPANY_EMAIL')->first())->value }} <br>
                        <strong>C: </strong>{{ optional($lov->where('label', 'COMPANY_CONTACT_NUMBER')->first())->value }} <br>
                        <strong>F: </strong>{{ optional($lov->where('label', 'COMPANY_FAX')->first())->value }} <br>
                    </div>
                </div>
            </td>
            <td>
                <a href="#" class="d-block mw-150px ms-sm-auto">
                    @if($lov->where('label', 'COMPANY_LOGO')->first())
                    <img alt="Logo" src="{{ asset($lov->where('label', 'COMPANY_LOGO')->first()->value) }}" class="w-100" width="200">
                    @else
                    No Logo
                    @endif
                </a>
                <!--end::Logo-->
            </td>
        </tr>
    </table>
    <h3 style="font-family: monospace; text-align: center;"><strong>PROOF OF REGISTRATION</strong></h3>

    <table style="width:100%;  font-family: monospace; font-size: 12px;">
        <tr>
            <td><strong>{{ __('Student Name') }}</strong></td>
            <td>:</td>
            <td>
                {{ $studentRegistration->userInfo->first_names }} {{ $studentRegistration->userInfo->surname }}
            </td>
        </tr>
        <tr>
            <td><strong>{{ __('Student Number') }}</strong></td>
            <td>:</td>
            <td>
                {{ $studentRegistration->userInfo->student_number }}
            </td>
        </tr>
        <tr>
            <td><strong>{{ __('ID Number') }}</strong></td>
            <td>:</td>
            <td>
                {{ $studentRegistration->userInfo->id_number }}
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <p style="font-weight:400; font-family: monospace; font-size: 12px;">
                    <strong>This is to certify that the student has been registered as follows:</strong>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <br>
            </td>
        </tr>
        <tr>
            <td><strong>{{ __('Qualification') }}</strong></td>
            <td>:</td>
            <td>
                {{ $studentRegistration->qualification->qualification_name }} ({{ $studentRegistration->qualification->qualification_code }}
            </td>
        </tr>
        <tr>
            <td><strong>{{ __('Year Level') }}</strong></td>
            <td>:</td>
            <td>
                {{ $studentRegistration->yearLevel->year_level }}
            </td>
        </tr>
        <tr>
            <td><strong>{{ __('Academic Year') }}</strong></td>
            <td>:</td>
            <td>
                {{ $studentRegistration->academicYear->name }}
            </td>
        </tr>

        <tr>
            <td><strong>{{ __('Academic Intake') }}</strong></td>
            <td>:</td>
            <td>
                {{ $studentRegistration->academicIntake->name }}
            </td>
        </tr>

        <tr>
            <td><strong>{{ __('Study Mode') }}</strong></td>
            <td>:</td>
            <td>
                {{ $studentRegistration->studyMode->study_mode }}
            </td>
        </tr>

        <tr>
            <td><strong>{{ __('Campus') }}</strong></td>
            <td>:</td>
            <td>
                {{ $studentRegistration->campus->name }}
            </td>
        </tr>
    </table>
    <br>
    <table style="width:100%;  font-family: monospace; font-size: 12px; border-collapse: collapse;">
        <tr style="padding: 5px;">
            <th style="text-align: left;">Module Name</th>
            <th style="text-align: left;">Module Code</th>
            <th style="text-align: left;">Study Mode</th>
            <th style="text-align: left;">Study Period</th>
        </tr>
        @foreach($moduleRegistration as $registration)
        <tr style="padding: 8px;">
            <td style="text-align: left;">{{$registration->module->module_name}}</td>
            <td style="text-align: left;">{{$registration->module->module_code}}</td>
            <td style="text-align: left;">{{$registration->studyMode->study_mode}}</td>
            <td style="text-align: left;">{{$registration->studyPeriod->study_period}}</td>
        </tr>
        @endforeach
    </table>
    <hr>
</div>