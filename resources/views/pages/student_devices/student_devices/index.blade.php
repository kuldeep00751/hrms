<x-base-layout>
    <script>
        $("#kt_daterangepicker_1").daterangepicker();
    </script>
    <div class="col-md-12 mx-auto mb-5">

        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h4>Search devices</h4>
                </div>

            </div>
            <form method="GET" action="{{ route('student_devices.filter') }}" accept-charset="UTF-8" class="form-horizontal">
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
                        <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Device IMEI') }}</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-9 fv-row">
                            <div class="input-group mb-5">
                                <input class="form-control" type="text" name="device_imei" id="device_imei" value="{{old('device_imei')}}" aria-describedby="reference-addon">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9 bg-white">
                    <a href="{{ route('student_devices.index') }}" class="btn btn-white btn-active-light-primary me-2">{{ __('Reset') }}</a>

                    <button type="button" class="btn btn-primary">
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
                    <h3>Student Devices</h3>
                </div>

                <div class="pull-right" role="group">
                    <a href="{{ route('student_devices.create') }}" class="btn btn-sm btn-primary">
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

                @if(!count($studentDevices))
                <div class="alert alert-danger">
                    No student devices captured.
                </div>
                @else
                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">

                        <table class="table table-row-dashed" id="kt_datatable_example">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Student Number</th>
                                    <th>Student Name</th>
                                    <th>Academic Year</th>
                                    <th>Issue Date</th>
                                    <th>Valid Until</th>
                                    <th>Device IMEI</th>
                                    <th>Description</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentDevices as $studentDevice)

                                <tr>
                                    <td>{{ $studentDevice->userInfo->student_number }}</td>
                                    <td>{{ $studentDevice->userInfo->first_names }} {{ $studentDevice->userInfo->surname }} </td>
                                    <td>{{ $studentDevice->academicYear->name }} </td>
                                    <td>{{ date('d M Y', strtotime($studentDevice->issue_date))}}</td>
                                    <td>{{ date('d M Y', strtotime($studentDevice->valid_until)) }}</td>
                                    <td>{{ $studentDevice->studentDeviceInventory->device_imei }}</td>
                                    <td>{{ $studentDevice->studentDeviceInventory->description }}</td>
                                    <td>
                                        <a href="{{ route('student_devices.sim_replacement', $studentDevice->id ) }}" target="__blank" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
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