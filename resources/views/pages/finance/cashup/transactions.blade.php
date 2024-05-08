<x-base-layout>
    <script>
        $("#kt_daterangepicker_1").daterangepicker();
    </script>

    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="pull-right" role="group">
                    <a href="/finance/cashup-report?from_date={{$fromDate}}&to_date={{$toDate}}" class="btn btn-sm btn-secondary">
                        <i class="fa-solid fa-chevron-left"></i> Cash up
                    </a>
                </div>
                <div class="pull-right">
                    <h3>Transactions </h3>
                </div>

                <div class="pull-right" role="group">
                    <a href="{{ route('finance.cashup.transactions-print', [$paypoint, $user, $payments->first()->payment_date]) }}" class="btn btn-sm btn-secondary" target="_blank">
                        <i class="fa-solid fa-print"></i> Print Transactions
                    </a>
                </div>
            </div>
            <div class="card-body">

                @if(!count($payments))
                <div class="alert alert-danger">
                    No payment transactions found. Please refine your search above
                </div>
                @else
                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">

                        <table class="table table-row-dashed" id="kt_datatable_example">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Student Number</th>
                                    <th>Student Name</th>
                                    <th>Reference Number</th>
                                    <th>Payment Point</th>
                                    <th>Received By</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                <tr>
                                    <td>{{$payment->student_number}}</td>
                                    <td>{{$payment->student_name}} {{$payment->student_surname}}</td>
                                    <td>{{ $payment->payment_reference }} </td>
                                    <td>{{ $payment->campus_name }}</td>
                                    <td>{{ $payment->first_name }} {{ $payment->last_name }}</td>
                                    <td>{{ number_format($payment->amount, 2, '.', ',') }}</td>
                                    <td>{{ $payment->payment_method}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5" class="text-right"><strong>Total</strong></th>
                                    <th><strong>{{ number_format($payments->sum('amount'), 2, '.', ',') }}</strong></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-base-layout>