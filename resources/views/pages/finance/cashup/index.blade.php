<x-base-layout>
    <script>
        $("#kt_daterangepicker_1").daterangepicker();
    </script>
    <div class="col-md-12 mx-auto mb-5">

        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h4>Search payment</h4>
                </div>

            </div>
            <form method="GET" action="{{ route('finance.cashup.index') }}" accept-charset="UTF-8" class="form-horizontal">
                <div class="card-body">
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <i class="fa-solid fa-circle-xmark text-danger"></i>
                        {{ $error }}
                        @endforeach
                    </ul>
                    @endif
                    <div class="row mb-2">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label fw-bold fs-6 text-right">{{ __('From Date') }}</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <input class="form-control" type="date" name="from_date" id="from_date" value="{{ $fromDate }}">
                        </div>
                    </div>


                    <div class="row mb-2">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('To Date') }}</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <input class="form-control" type="date" name="to_date" id="to_date" value="{{ $toDate }}">
                        </div>
                    </div>

                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9 bg-white">
                    <a href="{{ route('finance.cashup.index') }}" class="btn btn-white btn-active-light-primary me-2">{{ __('Reset') }}</a>

                    <button type="submit" class="btn btn-primary">
                        {{ __('Search') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">

                <div class="pull-left">
                    <h3>Payments</h3>
                </div>

                <!-- <div class="pull-right" role="group">
                    <a href="{{ route('payments.create') }}" class="btn btn-sm btn-primary" title="Create New Subject Fee">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                </div> -->
            </div>
            <div class="card-body">
                @if(Session::has('success_message'))
                <div class="alert alert-success">
                    <h6 class="text-success">
                        <i class="fa-solid fa-circle-check text-success"></i>
                        {!! session('success_message') !!}
                    </h6>
                </div>
                @endif

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
                                    <th>Date</th>
                                    <th>Payment Point</th>
                                    <th>Received By</th>
                                    <th>Total Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->payment_date }} </td>
                                    <td>{{ $payment->campus_name }}</td>
                                    <td>{{ $payment->first_name }} {{ $payment->last_name }}</td>
                                    <td><a href="{{ route('finance.cashup.transactions', [$payment->campus_id, $payment->user_id, $payment->payment_date])}}">{{ number_format($payment->amount, 2, '.', ',') }} </a></td>
                                    <td>
                                        <a href="{{ route('finance.cashup.receipt', [$payment->campus_id, $payment->user_id, $payment->payment_date]) }}" target="__blank" class="btn btn-sm btn-light btn-active-light-primary">Cash up Receipt</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-base-layout>