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
    <h3 style="font-family: monospace; text-align: center;"><strong>CASH-UP TRANSACTIONS</strong></h3>

    <table style="width:50%;  font-family: monospace;">
        <tr>
            <td><strong>{{ __('Cashier') }}</strong></td>
            <td>:</td>
            <td>
                {{ $payments->first()->first_name }} {{ $payments->first()->last_name }}
            </td>
        </tr>
        <tr>
            <td><strong>{{ __('Paypoint') }}</strong></td>
            <td>:</td>
            <td>
                {{ $payments->first()->campus_name }}
            </td>
        </tr>
        <tr>
            <td><strong>{{ __('Date') }}</strong></td>
            <td>:</td>
            <td>
                {{ date('d/m/Y',strtotime($payments->first()->payment_date))}}
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <br>
            </td>
        </tr>
    </table>

    <table style="width:100%;  font-family: monospace; font-size: 12px;">

        <tr class="fw-bold fs-6 text-gray-800 bg-gray-300">
            <th style="text-align: left; padding: 5px; border-bottom: 1px dashed black;">Student Number</th>
            <th style="text-align: left; padding: 5px; border-bottom: 1px dashed black;">Student Name</th>
            <th style="text-align: left; padding: 5px; border-bottom: 1px dashed black;">Reference Number</th>
            <th style="text-align: left; padding: 5px; border-bottom: 1px dashed black;">Payment Point</th>
            <th style="text-align: left; padding: 5px; border-bottom: 1px dashed black;">Received By</th>
            <th style="text-align: left; padding: 5px; border-bottom: 1px dashed black;">Amount</th>
            <th style="text-align: left; padding: 5px; border-bottom: 1px dashed black;">Payment Method</th>
        </tr>

        @foreach($payments as $payment)
        <tr>
            <td style="text-align: left; padding: 5px;">{{$payment->student_number}}</td>
            <td style="text-align: left; padding: 5px;">{{$payment->student_name}} {{$payment->student_surname}}</td>
            <td style="text-align: left; padding: 5px;">{{ $payment->payment_reference }} </td>
            <td style="text-align: left; padding: 5px;">{{ $payment->campus_name }}</td>
            <td style="text-align: left; padding: 5px;">{{ $payment->first_name }} {{ $payment->last_name }}</td>
            <td style="text-align: left; padding: 5px;">{{ number_format($payment->amount, 2, '.', ',') }}</td>
            <td style="text-align: left; padding: 5px;">{{ $payment->payment_method}}</td>
        </tr>
        @endforeach
        <tr>
            <th colspan="5" style="text-align: left; padding: 5px;">
                <strong>Total Cash-up</strong>
            </th>
            <th style="text-align: left; padding: 5px;">
                <strong>{{number_format($payments->sum('amount'), 2, '.',',')}}</strong>
            </th>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <table style="width:100%;  font-family: monospace;">
        <tr>
            <td style="text-align: left; padding: 5px;">
                Cashier:<br>
                ___________________________________<br>
                <strong>{{ $payments->first()->first_name }} {{ $payments->first()->last_name }}</strong>
            </td>
            <td></td>
            <td style="text-align: left; padding: 5px;">
                Name & Signature:<br>
                __________________________________<br>
                <strong>(Supervisor)</strong>
            </td>
        </tr>

    </table>


</div>