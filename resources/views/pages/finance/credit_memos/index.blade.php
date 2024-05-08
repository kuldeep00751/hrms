<x-base-layout>
    <div class="row">
        <div class="col-md-12 mb-5">

            <div class="bg-white p-5">
                <form method="POST" action="{{ route('finance.credit_memos.filter') }}" accept-charset="UTF-8" class="form-horizontal">
                    @csrf
                    <div class="row">


                        <div class="col-4">
                            <!--begin::Label-->
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Student number:') }}</label>
                            <!--end::Label-->
                            <div class="form-group {{ $errors->has('student_number') ? 'has-error' : '' }}">
                                <div class="col-md-12">
                                    <input class="form-control" name="student_number" type="number" id="student_number" value="{{ old('student_number', $filterData['student_number'] ?? '') }}" placeholder="Enter student number here...">
                                </div>
                            </div>

                        </div>

                        <div class="col-4">
                            <!--begin::Label-->
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('ID Number/Passport:') }}</label>
                            <!--end::Label-->
                            <div class="form-group {{ $errors->has('id_number') ? 'has-error' : '' }}">
                                <div class="col-md-12">
                                    <input class="form-control" name="id_number" type="text" id="id_number" value="{{ old('id_number', $filterData['id_number'] ?? '') }}" placeholder="Enter ID or Passport number here...">
                                </div>
                            </div>

                        </div>

                        <div class="col-4">
                            <!--begin::Label-->
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Surname:') }}</label>
                            <!--end::Label-->
                            <div class="form-group {{ $errors->has('surname') ? 'has-error' : '' }}">
                                <div class="col-md-12">
                                    <input class="form-control" name="surname" type="text" id="surname" value="{{ old('surname', $filterData['surname'] ?? '') }}" placeholder="Enter Surname here...">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="separator separator-dashed mx-5 my-5"></div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('finance.credit_memos.index') }}" class="btn btn-active-light-primary me-2">{{ __('Reset') }}</a>

                        <button type="submit" class="btn btn-primary">
                            {{ __('Search') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <strong>Credit Memos</strong>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('finance.credit_memos.create') }}" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-plus"></i> Add New
                        </a>
                        <a href="{{ route('finance.credit_memos.createBulk') }}" class="btn btn-sm btn-light btn-active-light-info">
                            <i class="fa-solid fa-plus"></i> Add Bulk Credit Memos
                        </a>
                    </div>
                </div>
                @if(count($creditMemos) == 0)
                <div class="card-body text-center">
                    <div class="alert alert-danger">
                        No credit memo information found. Please refine your search above
                    </div>
                </div>
                @else
                <div class="card-body">
                    @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <h6 class="text-success">
                            <i class="fa-solid fa-circle-check text-success"></i>
                            {!! session('success_message') !!}
                        </h6>
                    </div>
                    @endif
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <i class="fa-solid fa-circle-xmark text-danger"></i>
                        {{ $error }}
                        @endforeach
                    </ul>
                    @endif
                    <div class="table-responsive">

                        <table class="table table-row-dashed" id="kt_datatable_example">
                            <thead>
                                <tr class="text-gray-400 fw-bold text-uppercase">
                                    <th>Student Number</th>
                                    <th>Surname</th>
                                    <th>First Name</th>
                                    <th>Transaction ID</th>
                                    <th>Transaction Date</th>
                                    <th>Description</th>
                                    <th>Amount (N$)</th>
                                    <th>Added By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($creditMemos as $creditMemo)
                                <tr>
                                    <td>{{ $creditMemo->userInfo->student_number }}</td>
                                    <td>{{ $creditMemo->userInfo->surname }} </td>
                                    <td>{{ $creditMemo->userInfo->first_names }} </td>
                                    <td>{{ $creditMemo->transaction_id }}</td>
                                    <td>{{ $creditMemo->transaction_date }}</td>
                                    <td>{{ $creditMemo->transaction_description }}</td>
                                    <td>{{ $creditMemo->amount }}</td>
                                    <td>{{ $creditMemo->createdBy->first_name }} {{ $creditMemo->createdBy->last_name }}</td>
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