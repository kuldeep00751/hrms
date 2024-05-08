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

    @php
    $info = $subjectDetails->first();
    @endphp
    <h3 style="font-family: monospace; text-align:center"><strong>ACADEMIC TRANSCRIPT</strong></h3>

    <table style="width:100%;  font-family: monospace;">
        <tr>
            <td><strong>{{ __('Student Name') }}</strong></td>
            <td>:</td>
            <td>
                {{$info->title}} {{ $info->first_names }} {{ $info->surname }}
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
            <td><strong>{{ __('Qualification') }}</strong></td>
            <td>:</td>
            <td>
                {{ $info->qualification_name }} ({{ $info->qualification_code }})
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

    <table style="width:100%;  font-family: monospace; font-size:12px;">
        <tr>
            <td colspan="9">
                <hr style="border: 1px dashed lightgrey;">
            </td>
        </tr>
        @php
        $currentYear = null;
        $promotionStatus = null;
        @endphp
        @foreach($subjectDetails as $subjectDetail)
        @if (!isset($currentYear) || $currentYear != $subjectDetail->academic_year)
        <!-- Display the subjects for the current year -->
        @if ($currentYear !== null)
        <tr style="padding-top: 20px; font-size: 12px;">
            <td colspan="9" style="padding-top: 20px; font-size: 12px;">
                <strong>
                    <h4>Annual Result for {{ $currentYear }}: {{ $promotionStatus }}</h4>
                </strong>
            </td>
        </tr>

        <tr>
            <td colspan="9">
                <hr style="border: 1px dashed lightgrey;">
            </td>
        </tr>
        <tr>
            <td colspan="9">
                <div style="page-break-before: always;"> </div>
            </td>
        </tr>
        @endif
        <!-- Update current year and promotion status -->
        @php
        $currentYear = $subjectDetail->academic_year;
        $promotionStatus = $subjectDetail->promotion_result;
        @endphp
        <tr style="padding: 2px; font-size: 12px;">
            <td colspan="9"><strong>
                    <h4>Academic Year: {{ $subjectDetail->academic_year }}</h4>
                </strong></td>
        </tr>
        @endif
        <tr style="padding: 2px; font-size: 12px;">
            <td style="text-align: left; width: 40%">{{$subjectDetail->module_name}}</td>
            <td style="text-align: left; width: 10%">{{$subjectDetail->module_code}}</td>
            <td style="text-align: left; width: 20%">{{$subjectDetail->assessment_type}}</td>
            <td style="text-align: left; width: 5%">{{$subjectDetail->final_mark ?? 0}}</td>
            <td style="text-align: left; width: 25%;">{{ $subjectDetail->result_code_description }}</td>
        </tr>
        @endforeach
        <!-- Display promotion status for the last year -->
        <tr style="padding-top: 20px; font-size: 12px;">
            <td colspan="9" style="padding-top: 20px; font-size: 12px;"><strong>Annual Result for {{ $currentYear }}: {{ $promotionStatus }}</strong></td>
        </tr>
        <!--end::Table rows-->
        <!--end::Table row-->
    </table>

</div>