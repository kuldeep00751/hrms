<div id="section-to-print" onload="window.onload = function() { window.print(); }" style="border: 1px solid #ccc; padding: 10px; ">
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
                    <img alt="Logo" src="{{ asset($lov->where('label', 'COMPANY_LOGO')->first()->value) }}" class="w-100" width="100">
                    @else
                    No Logo
                    @endif
                </a>
                <!--end::Logo-->
            </td>
        </tr>
    </table>
    <h3 style="font-family: monospace; text-align: center;"><strong>STUDENT RECEIPT</strong></h3>
    <br>
    <table>
        <tr>
            <td>
                <div class="fw-bold fs-2" style="font-family: monospace;">
                    <strong>{{$payment->userInfo->first_names}} {{$payment->userInfo->surname}}<br></strong>
                    <span class="text-muted fs-5">{{$payment->userInfo->student_number}}</span><br>
                    <span class="text-muted fs-5">C: {{$payment->userInfo->mobile_number}}</span><br>
                    <span class="text-muted fs-5">E: {{$payment->userInfo->email_address}}</span><br>
                </div>
            </td>
        </tr>
    </table>

    <br>
    <br>
    <br>
    <hr>
    <table class="table" style="width: 100%; font-family: monospace; margin-top: 20px;">
        <tr style="border: 1px solid #000;">
            <th style="text-align: left;">Reference</th>
            <th style="text-align: left;">Payment Date</th>
            <th style="text-align: left;">Description</th>
            <th style="text-align: left;">Amount Paid</th>
            <th style="text-align: left;">Balance</th>
        </tr>
        <tr style="border: 1px solid #000;">
            <td>{{$payment->payment_reference}}</td>
            <td>{{date('d M, Y', strtotime($payment->payment_date))}}</td>
            <td>{{$payment->payment_description}}</td>
            <td>N${{number_format($payment->payment_amount,2,".",",")}}</td>
            <td>N${{number_format($balance,2,".",",")}}</td>
        </tr>
    </table>

    <hr>
    <br>
    <br>
    <br>
    <table>
        <tr>
            <td style="font-family: monospace;">
                <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">
                    <div class="flex-root d-flex flex-column">
                        <strong>Banking Details</strong><br>
                        <span class="fs-6">
                            {{ $campus->bank_name}}<br>
                            Account Number: {{ $campus->account_number}}<br>
                            Branch Name: {{ $campus->branch_name}}<br>
                            Branch Code: {{ $campus->branch_code}}<br>
                            Swift Code: {{ $campus->swift_code}} <br>
                            <br>
                            Your Reference: {{ $payment->userInfo->student_number}}
                        </span>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>