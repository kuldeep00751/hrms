<div id="section-to-print" onload="window.onload = function() { window.print(); }">
    <table style="width: 100%;">
        <tr>
            <td style="width: 80%">
                <h3 style="font-family: monospace;"><strong>SIM Replace Letter</strong></h3>
            </td>
            <td>
                <a href="#" class="d-block mw-150px ms-sm-auto">
                    <img alt="Logo" src="{{ asset('assets/media/logos/educims-logo.png') }}" class="w-100">
                </a>
                <!--end::Logo-->

                <!--begin::Text-->
                <div class="text-sm-end fw-semibold fs-4 text-muted mt-7">
                    <div style="font-family: monospace;">
                        <strong>Main Campus</strong>
                    </div>
                    <div style="font-family: monospace;">
                        Southern Industry, Windhoek
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <table style="width:100%;  font-family: monospace;">
        <tr>
            <td><strong>{{ __('Student Name') }}</strong></td>
            <td>:</td>
            <td>
                {{ $studentDevice->userInfo->first_names }} {{ $studentDevice->userInfo->surname }}
            </td>
        </tr>
        <tr>
            <td><strong>{{ __('Student Number') }}</strong></td>
            <td>:</td>
            <td>
                {{ $studentDevice->userInfo->student_number }}
            </td>
        </tr>
        <tr>
            <td><strong>{{ __('ID Number') }}</strong></td>
            <td>:</td>
            <td>
                {{ $studentDevice->userInfo->id_number }}
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <br>
            </td>
        </tr>
    </table>
    <tr>
        <td colspan="3">
            <p style="font-weight:400; font-family: monospace; ">
                <strong>This is to certify that the student has been issued the device below as follows:</strong>
            </p>
        </td>
    </tr>

    <br>
    <br>
    <br>

    <table style="width:100%;  font-family: monospace; border-collapse: collapse;" border="1">
        <tr class="fw-bold fs-6 text-gray-800 bg-gray-300" style="border: 1px solid #e6e6ef; padding: 10px;">
            <th style="text-align: left; padding: 10px;">Issue Date</th>
            <th style="text-align: left; padding: 10px;">SIM Mobile number</th>
            <th style="text-align: left; padding: 10px;">SIM Serial</th>
            <th style="text-align: left; padding: 10px;">Device IMEI</th>
        </tr>

        <tr style="border: 1px solid #e6e6ef; padding: 5px;">
            <td style="text-align: left; padding: 10px;">{{ $studentDevice->issue_date}}</td>
            <td style="text-align: left; padding: 10px;">{{ $studentDevice->mobile_number}}</td>
            <td style="text-align: left; padding: 10px;">{{ $studentDevice->sim_serial}}</td>
            <td style="text-align: left; padding: 10px;">{{ $studentDevice->device_imei}}</td>
        </tr>
    </table>

</div>