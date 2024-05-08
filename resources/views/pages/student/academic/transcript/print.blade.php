<div id="section-to-print" onload="window.onload = function() { window.print(); }">
    <table style="width: 100%;">
        <tr>
            <td style="width: 80%">
                <h3 style="font-family: monospace;"><strong>ACADEMIC TRANSCRIPT</strong></h3>
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
        </tr>
    </table>
    <br>
    <br>
    <br>
    @php
    $info = $subjectDetails->first();
    @endphp
    <table style="width:100%;  font-family: monospace;">
        <tr>
            <td><strong>{{ __('Student Name') }}</strong></td>
            <td>:</td>
            <td>
                {{ $info->first_names }} {{ $info->surname }}
            </td>
        </tr>
        <tr>
            <td><strong>{{ __('Student Number') }}</strong></td>
            <td>:</td>
            <td>
                {{ $info->student_number }}
            </td>
        </tr>
        <tr>
            <td><strong>{{ __('ID Number') }}</strong></td>
            <td>:</td>
            <td>
                {{ $info->id_number }}
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <br>
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
                {{ $info->qualification_name }} ({{ $info->qualification_code }}
            </td>
        </tr>


        <tr>
            <td><strong>{{ __('Academic Intake') }}</strong></td>
            <td>:</td>
            <td>
                {{ $info->academic_intake }}
            </td>
        </tr>

        <tr>
            <td><strong>{{ __('Study Mode') }}</strong></td>
            <td>:</td>
            <td>
                {{ $info->study_mode }}
            </td>
        </tr>

        <tr>
            <td><strong>{{ __('Campus') }}</strong></td>
            <td>:</td>
            <td>
                {{ $info->campus_name }}
            </td>
        </tr>
    </table>

    <br>
    <br>
    <br>

    <table style="width:100%;  font-family: monospace; border-collapse: collapse;">
        <tr class="fw-bold fs-6 text-gray-800 bg-gray-300" style=" padding: 5px;">
            <th style="text-align: left; padding: 10px;">Module Name</th>
            <th style="text-align: left; padding: 10px;">Module Code</th>
            <th style="text-align: left; padding: 10px;">Exam Type</th>
            <th style="text-align: left; padding: 10px;">Final Mark</th>
            <th style="text-align: left; padding: 10px;">Result</th>
        </tr>
        @foreach($subjectDetails as $subjectDetail)
        @if (!isset($currentYear) || $currentYear != $subjectDetail->academic_year)
        <tr>
            <td style="text-align: left; padding: 5px; font-size: 16px;" colspan="5"><strong>{{ $subjectDetail->academic_year }}</strong></td>
        </tr>
        @php
        $currentYear = $subjectDetail->academic_year;
        @endphp
        @endif
        <tr style="padding: 2px;">
            <td style="text-align: left; padding: 5px;">{{$subjectDetail->module_name}}</td>
            <td style="text-align: left; padding: 5px;">{{$subjectDetail->module_code}}</td>
            <td style="text-align: left; padding: 5px;">{{$subjectDetail->assessment_type}}</td>
            <td style="text-align: left; padding: 5px;">
                @if($suppress)
                <i>Suppressed</i>
                @else
                {{$subjectDetail->final_mark}}
                @endif

            </td>
            <td style="text-align: left; padding: 5px;">
                @if($suppress)
                <i>Suppressed</i>
                @else
                {{ $subjectDetail->result_code_description }}
                @endif
            </td>
        </tr>
        @endforeach
    </table>

</div>