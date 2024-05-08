<x-base-layout>
    <div class="row col-sm-12 col-md-9 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <a href="/finance/payments" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Payments</a>
                </div>
                <div class="card-title">
                    <h5>Transaction</h5>
                </div>
            </div>
            @if($cashierPaypoint)
            <form method="POST" action="{{ route('payments.store') }}" accept-charset="UTF-8" class="form-horizontal">
                {{ csrf_field() }}
                <div class="card-body">
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <i class="fa-solid fa-circle-xmark text-danger"></i>
                        {{ $error }}
                        @endforeach
                    </ul>
                    @endif
                    <div class="row">
                        <input class="form-control mb-5" type="text" name="student_number" id="student_number" value="{{old('student_number')}}" placeholder="Enter student number...">
                        <div class="col-md-6 border p-3 mr-5">
                            <h6>Student Information</h6>
                            <hr class="text-muted">
                            <div class="mb-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <input class="form-control" type="hidden" name="user_info_id" id="user_info_id" value="{{old('user_info_id')}}" required>
                                <input class="form-control" type="hidden" name="received_by" id="received_by" value="{{ auth()->user()->id }}" required>
                                <p class="help-block text-danger" id="student_number_error"></p>
                                <div id="student_info">
                                    <p class="text-danger">
                                        <i> Please use the field above to search for a student</i>
                                    </p>
                                </div>
                            </div>


                        </div>
                        <div class="col-md-6 p-3 border">
                            <h6>Paypoint</h6>
                            <hr class="text-muted">
                            <span class="fs-6">
                                <strong>{{ $cashierPaypoint->campus->name}}</strong><br>
                                {{ $cashierPaypoint->campus->address_line_1}} <br>
                                {{ $cashierPaypoint->campus->address_line_2}}<br>
                                {{ $cashierPaypoint->campus->address_line_3}}
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 p-5 border mt-5">
                            <h6>Transaction Information</h6>
                            <hr class="text-muted">
                            <div class="mb-5 form-group {{ $errors->has('payment_date') ? 'has-error' : '' }}">
                                <label for="payment_date" class="control-label">Payment Date <span class="text-danger">*</span></label>
                                <div class="col-md-12">
                                    <input class="form-control" name="payment_date" type="date" id="payment_date" value="{{ old('payment_date', date('Y-m-d')) }}" placeholder="Select payment date...">
                                    {!! $errors->first('payment_date', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="mb-5 form-group {{ $errors->has('pop_reference') ? 'has-error' : '' }}">
                                <label for="pop_reference" class="control-label">Proof of Payment Reference Number</label>
                                <div class="col-md-12">
                                    <input class="form-control" name="pop_reference" type="text" id="pop_reference" value="{{ old('pop_reference') }}" placeholder="Enter POP Reference number...">
                                    {!! $errors->first('pop_reference', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="mb-5 form-group {{ $errors->has('payment_amount') ? 'has-error' : '' }}">
                                <label for="payment_amount" class="control-label">Payment Amount <span class="text-danger">*</span></label>
                                <div class="col-md-12">
                                    <input class="form-control" name="payment_amount" type="number" id="payment_amount" step="0.01" value="{{ old('payment_amount') }}" placeholder="Enter amount paid...">
                                    {!! $errors->first('payment_amount', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>


                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('payment_method_id') ? 'has-error' : '' }}">
                                        <label for="payment_description_id" class="control-label">Payment Description <span class="text-danger">*</span></label>

                                        <select class="form-control" id="payment_description_id" name="payment_description" required>
                                            <option value="" style="display: none;" {{ old('payment_description') ? 'selected' : '' }} disabled selected>Select payment description</option>
                                            @foreach ($paymentDescriptions as $key => $paymentDescription)
                                            <option value="{{ $key }}" {{ old('payment_description') == $key ? 'selected' : '' }}>
                                                {{ $paymentDescription }}
                                            </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('payment_description', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('payment_method_id') ? 'has-error' : '' }}">
                                        <label for="payment_method_id" class="control-label">Payment Method <span class="text-danger">*</span></label>

                                        <select class="form-control" id="payment_method_id" name="payment_method_id" required>
                                            <option value="" style="display: none;" {{ old('payment_method_id') ? 'selected' : '' }} disabled selected>Select payment method</option>
                                            @foreach ($paymentMethods as $key => $paymentMethod)
                                            <option value="{{ $key }}" {{ old('payment_method_id') == $key ? 'selected' : '' }}>
                                                {{ $paymentMethod }}
                                            </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('payment_method_id', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9 bg-white">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Save') }}
                    </button>
                </div>
            </form>
            @else
            <div class="card-body">
                <div class="alert alert-danger">
                    You are not linked to a paypoint. Please contact your administrator
                </div>
            </div>

            @endif
        </div>
    </div>
    <script>
        let studentNumber = document.getElementById('student_number')

        let userInfoId = document.getElementById('user_info_id')

        let studentName = document.getElementById('student_name')

        let studentNumberError = document.getElementById('student_number_error')

        let studentInfoBox = document.getElementById('student_info');

        studentNumber.addEventListener('change', function(e) {
            let url = `/get-student-info/${studentNumber.value}`

            const response = fetch(url, {
                    method: "GET",
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status) {
                        userInfoId.value = data.user_info_id;
                        let studentInfo = `<span class="fs-6">
                                            <strong>${data.student_info.first_names} ${data.student_info.surname}</strong><br>
                                            ${data.student_info.email_address} <br>
                                            ${data.student_info.mobile_number}<br>
                                            ${(data.student_info.postal_address_line_1 == null) ? '':data.student_info.postal_address_line_1}<br>
                                            ${(data.student_info.postal_address_line_2 == null) ? '':data.student_info.postal_address_line_2}<br>
                                            ${(data.student_info.postal_address_line_3 == null) ? '':data.student_info.postal_address_line_3}
                                        </span>`;
                        studentNumberError.innerHTML = "";
                        studentInfoBox.innerHTML = studentInfo;
                    } else {
                        studentNumberError.innerHTML = data.message
                        userInfoId.value = "";
                        studentName.value = "";
                    }
                })
        })
    </script>
</x-base-layout>