<x-base-layout>
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-bottom border-gray-200">
            <!--begin::Title-->
            <div class="card-title">
                <h3 class="fw-bold m-0">Statement</h3>
            </div>
            <!--end::Title-->
        </div>
        <!--end::Card header-->
        <div class="card-body">
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-bordered align-middle gy-4 gs-9">
                    <thead class="border-bottom border-gray-200 fs-6 text-gray-600 fw-bold bg-light bg-opacity-75">
                        <tr>
                            <td class="min-w-150px">Transaction Date</td>
                            <td class="min-w-150px">Reference</td>
                            <td class="min-w-250px">Description</td>
                            <td class="min-w-150px">Debit</td>
                            <td class="min-w-150px">Credit</td>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        <!--begin::Table row-->
                        @php
                        $balance = 0;
                        @endphp
                        @foreach($studentAccounts as $studentAccount)
                        @php
                        $balance = ($studentAccount->debit > 0) ? $balance += $studentAccount->debit : $balance -= $studentAccount->credit;
                        @endphp
                        <tr>
                            <td>{{ date('M d, Y',strtotime($studentAccount->transaction_date)) }}</td>
                            <td>{{ $studentAccount->reference}}</td>
                            <td>{{ $studentAccount->transaction_description}}</td>
                            <td>N$ {{ number_format($studentAccount->debit, 2, '.',',')}}</td>
                            <td>N$ {{ number_format($studentAccount->credit, 2, '.',',')}}</td>
                        </tr>
                        @endforeach
                        <!--end::Table row-->
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">
                                @if($balance >= 0)
                                <h4>You are owing</h4>
                                @else
                                <h4>We owe you</h4>
                                @endif
                            </th>
                            <th>
                                <strong>N$ {{number_format($balance, 2, '.',',')}}</strong>
                            </th>
                        </tr>
                    </tfoot>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
    </div>
</x-base-layout>