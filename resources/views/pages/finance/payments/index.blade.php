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
            <form method="GET" action="{{ route('payments.filter') }}" accept-charset="UTF-8" class="form-horizontal">
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
                        <label class="col-lg-3 col-form-label fw-bold fs-6 text-right">{{ __('Student Number') }}</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <input class="form-control" type="text" name="student_number" id="student_number" value="{{old('student_number')}}">
                        </div>
                    </div>


                    <div class="row mb-2">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Reference Number') }}</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <div class="input-group mb-5">
                                <span class="input-group-text" id="reference-addon">PAY-</span>
                                <input class="form-control" type="text" name="payment_reference" id="payment_reference" value="{{old('payment_reference')}}" aria-describedby="reference-addon">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Payment Method') }}</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <select name="study_mode_id" aria-label="{{ __('Payment Method') }}" data-placeholder="{{ __('Select study mode...') }}" class="form-select form-select-solid form-select-lg fw-bold" required>
                                <option>Show all</option>
                                @foreach ($paymentMethods as $key => $paymentMethod)
                                @if(isset($filterData['payment_method_id']))
                                <option value="{{ $key }}" {{ old('payment_method_id', $filterData['payment_method_id']) == $key ? 'selected' : '' }}>
                                    @else
                                <option value="{{ $key }}">
                                    @endif
                                    {{ $paymentMethod }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9 bg-white">
                    <a href="{{ route('payments.index') }}" class="btn btn-white btn-active-light-primary me-2">{{ __('Reset') }}</a>

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

                <div class="pull-right" role="group">
                    <a href="{{ route('payments.create') }}" class="btn btn-sm btn-primary" title="Create New Subject Fee">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                </div>
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
                                    <th>Student Number</th>
                                    <th>Reference</th>
                                    <th>POP Reference</th>
                                    <th>Student Name</th>
                                    <th>Payment Description</th>
                                    <th>Payment Date</th>
                                    <th>Method</th>
                                    <th>Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->userInfo->student_number }} </td>
                                    <td>{{ $payment->payment_reference }}</td>
                                    <td>{{ $payment->pop_reference }}</td>
                                    <td>{{ $payment->userInfo->first_names }} {{ $payment->userInfo->surname }} </td>
                                    <td>{{ $payment->payment_description }}</td>
                                    <td>{{ date('d M, Y',strtotime($payment->payment_date)) }}</td>
                                    <td>{{ $payment->paymentMethod->payment_method }}</td>
                                    <td>{{ $payment->payment_amount }}</td>
                                    <td>
                                        <a href="{{ route('payments.print', $payment->id ) }}" target="__blank" class="btn btn-sm btn-light btn-active-light-primary">Print</a>
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