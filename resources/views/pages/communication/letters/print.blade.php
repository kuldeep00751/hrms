<div id="section-to-print" onload="window.onload = function() { window.print(); }" style="border: 1px solid #ccc; padding: 10px;">
    @php
    $lov = App\Models\Lov::all();
    @endphp
    <table style="width: 100%;">
        <tr>
            <td style="width: 80%">
                <!--begin::Text-->
                <div class="text-sm-end fw-semibold fs-4 text-muted mt-7">
                    <div>
                        <strong>{{ $lov->where('label', 'COMPANY_NAME')->first()->value }}</strong>
                    </div>
                    <div>
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
    <div class="card-body">
        {!! $studentLetter->generateLetter($studentLetter->content, $letterParameters) !!}
    </div>
</div>