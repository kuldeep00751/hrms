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
    <h3 style="font-family: monospace; text-align: center;"><strong>STUDENT STATEMENT</strong></h3>

    <table style="width:100%;  font-family: monospace;">
        <tr>
            <td><strong>{{ __('Student Name') }}</strong></td>
            <td>:</td>
            <td>
                {{ $userInfo->first_names }} {{ $userInfo->surname }}
            </td>
        </tr>
        <tr>
            <td><strong>{{ __('Student Number') }}</strong></td>
            <td>:</td>
            <td>
                {{ $userInfo->student_number }}
            </td>
        </tr>
        <tr>
            <td><strong>{{ __('ID Number') }}</strong></td>
            <td>:</td>
            <td>
                {{ $userInfo->id_number }}
            </td>
        </tr>
        <tr>
            <td><strong>{{ __('Course') }}</strong></td>
            <td>:</td>
            <td>
                {{ $latestQualification->qualification_name }} ({{ $latestQualification->qualification_code }})
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <br>
            </td>
        </tr>
    </table>

    <table style="width:100%;  font-family: monospace;">
        <tr class="fw-bold fs-6 text-gray-800 bg-gray-300">
            <th style="text-align: left; padding: 5px;">Date</th>
            <th style="text-align: center; padding: 5px;">Reference</th>
            <th style="text-align: left; padding: 5px;">Description</th>
            <th style="text-align: left; padding: 5px;">Debit(NAD)</th>
            <th style="text-align: right; padding: 5px;">Credit(NAD)</th>
        </tr>
        @php
        $balance = 0;
        @endphp
        @foreach($studentAccounts as $studentAccount)
        @php
        $balance = ($studentAccount->debit > 0) ? $balance += $studentAccount->debit : $balance -= $studentAccount->credit;
        @endphp
        <tr>
            <td style="text-align: left;">{{ date('d/m/Y',strtotime($studentAccount->transaction_date)) }}</td>
            <td style="text-align: center;">{{ $studentAccount->reference}}</td>
            <td style="text-align: left;">{{ $studentAccount->transaction_description}}</td>
            <td style="text-align: left;">{{ number_format($studentAccount->debit, 2, '.',',')}}</td>
            <td style="text-align: right;">{{ number_format($studentAccount->credit, 2, '.',',')}}</td>
        </tr>
        @endforeach
        <tr>
            <th colspan="5">
                <hr>
            </th>
        </tr>
        <tr>
            <th colspan="4">
                @if($balance >= 0)
                <h4>You are owing</h4>
                @else
                <h4>We owe you</h4>
                @endif
            </th>
            <th style="text-align: left; padding: 5px;">
                <strong>N${{number_format($balance, 2, '.',',')}}</strong>
            </th>
        </tr>
    </table>

</div>