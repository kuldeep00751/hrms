<x-base-layout>
    <div class="row col-sm-12 col-md-10 mx-auto">

        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <a href="{{ route('student_devices.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Student Devices</a>
                </div>
                <div class="card-title">
                    <h5>Allocate student devices</h5>
                </div>
            </div>
            <form method="POST" action="{{ route('student_devices.store') }}" accept-charset="UTF-8" class="form-horizontal">
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

                    <div class="row mb-5">
                        <input class="form-control mb-5" type="text" name="student_number" id="student_number" value="{{old('student_number')}}" placeholder="Enter student number...">
                        <div class="col-md-6 border p-3 mr-5">
                            <h6>Student Information</h6>
                            <hr class="text-muted">
                            <div class="mb-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <input class="form-control" type="hidden" name="user_info_id" id="user_info_id" value="{{old('user_info_id')}}" required>
                                <input class="form-control" type="hidden" name="captured_by" id="captured_by" value="{{ auth()->user()->id }}" required>
                                <input class="form-control" type="hidden" name="academic_year_id" id="academic_year_id" value="{{old('academic_year_id')}}" required>

                                <p class="help-block text-danger" id="student_number_error"></p>
                                <div id="student_info">
                                    <p class="text-danger">
                                        <i> Please use the field above to search for a student</i>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-3 border">
                            <h6>Registration Information</h6>
                            <hr class="text-muted">
                            <div id="registration">
                                <p class="text-danger">
                                    <i> Student registration information will appear here.</i>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5 form-group {{ $errors->has('issue_date') ? 'has-error' : '' }}">
                        <label for="issue_date" class="control-label">Issue Date <span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input class="form-control" name="issue_date" type="date" id="issue_date" value="{{ old('issue_date', date('Y-m-d')) }}" placeholder="Select issue date...">
                        </div>
                    </div>

                    <div class="table-responsive border p-5">
                        <table class="table table-row-dashed" id="student_device_table">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Device IMEI</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Valid Until</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="student-device-tbl-body">
                                <tr>
                                    <td>
                                        <input class="form-control devices" name="device_imei[]" type="number" value="">
                                    </td>
                                    <td>
                                        <input class="form-control device-type" type="text" value="" readonly required>
                                    </td>
                                    <td>
                                        <input class="form-control description" type="text" value="" readonly required>
                                    </td>
                                    <td>
                                        <input class="form-control valid-until-date" name="valid_until[]" type="date" value="" placeholder="Select issue date...">
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-lg-4">
                                <button type="button" id="btn-add-device" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Add Student Device </button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9 bg-white">
                    <button type="submit" class="btn btn-primary" id="">
                        {{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        let studentNumber = document.getElementById('student_number')

        let userInfoId = document.getElementById('user_info_id')

        let academicYearId = document.getElementById('academic_year_id')

        let studentNumberError = document.getElementById('student_number_error')

        let studentInfoBox = document.getElementById('student_info');

        let studentRegistrationBox = document.getElementById('registration');

        studentNumber.addEventListener('change', function(e) {
            let url = `get-student-info/${studentNumber.value}`

            const response = fetch(url, {
                    method: "GET",
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status) {
                        console.log(data.userInfo)
                        userInfoId.value = data.userInfo.id;
                        academicYearId.value = data.registration.academic_year_id;

                        let studentInfo = `<span class="fs-6">
                                            <strong>${data.userInfo.first_names} ${data.userInfo.surname}</strong><br>
                                            ID: ${data.userInfo.id_number} <br>
                                            E: ${data.userInfo.email_address} <br>
                                            C: ${data.userInfo.mobile_number}<br>
                                            Address Line 1: ${(data.userInfo.postal_address_line_1 == null) ? '':data.userInfo.postal_address_line_1}<br>
                                            Address Line 2: ${(data.userInfo.postal_address_line_2 == null) ? '':data.userInfo.postal_address_line_2}<br>
                                            Address Line 3: ${(data.userInfo.postal_address_line_3 == null) ? '':data.userInfo.postal_address_line_3}
                                        </span>`;

                        let registration = `<span class="fs-6">
                                            <strong>${data.registration.qualification.qualification_name} (${data.registration.qualification.qualification_code})</strong><br>
                                            ${data.registration.study_mode.study_mode} <br>
                                            ${data.registration.academic_intake.name} <br>
                                            ${data.registration.campus.name}
                                        </span>`;

                        studentNumberError.innerHTML = "";

                        studentInfoBox.innerHTML = studentInfo;
                        studentRegistrationBox.innerHTML = registration;
                    } else {
                        console.log(studentRegistrationBox);
                        studentNumberError.innerHTML = data.message
                        userInfoId.value = "";
                        studentInfoBox.innerHTML = "";
                        studentRegistrationBox.innerHTML = `<span class="text-danger">${data.message}</span>`;
                    }
                })
        })
    </script>
</x-base-layout>