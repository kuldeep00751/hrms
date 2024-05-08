<x-base-layout>
    <div class="card">
        <div class="card-header">
            <div class="pull-left">
                <a href="{{ route('finance.student_statement.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Back</a>
            </div>
            <div class="pull-right">
                <a href="{{ route('finance.student_statement.print', $userInfo->id) }}" class="btn btn-sm btn-primary" target="_blank">
                    <i class="fa-solid fa-print"></i> Printable Version
                </a>
            </div>
        </div>
        <div class="card-body">
            <h3 class="fw-bold mb-5">Student Statement</h3>
            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('Student Name') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $userInfo->first_names }} {{ $userInfo->surname }} </span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('Student Number') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $userInfo->student_number }} </span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('ID Number') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $userInfo->id_number }} </span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row">
                <!--begin::Label-->
                <label class="col-md-3 fw-bold text-muted">{{ __('Course') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bolder fs-6 text-dark">{{ $latestQualification->qualification_name ?? '' }} ({{ $latestQualification->qualification_code ?? '' }}) </span>
                </div>
                <!--end::Col-->
            </div>
        <br>
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