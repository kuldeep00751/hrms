<x-base-layout>
    <div class="row">
        <div class="col-md-12 mb-5">

            <div class="bg-white p-5">
                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
                <form method="POST" action="{{ route('academic_record.qualifications') }}" accept-charset="UTF-8" class="form-horizontal">
                    @csrf
                    <div class="row">


                        <div class="col-6">
                            <!--begin::Label-->
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Student number:') }}</label>
                            <!--end::Label-->
                            <div class="form-group {{ $errors->has('student_number') ? 'has-error' : '' }}">
                                <div class="col-md-12">
                                    <input class="form-control" name="student_number" type="number" id="student_number" value="{{ old('student_number', $filterData['student_number'] ?? '') }}" placeholder="Enter student number here...">
                                </div>
                            </div>

                        </div>

                        <div class="col-6">
                            <!--begin::Label-->
                            <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('ID Number/Passport:') }}</label>
                            <!--end::Label-->
                            <div class="form-group {{ $errors->has('id_number') ? 'has-error' : '' }}">
                                <div class="col-md-12">
                                    <input class="form-control" name="id_number" type="text" id="id_number" value="{{ old('id_number', $filterData['id_number'] ?? '') }}" placeholder="Enter ID or Passport number here...">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="separator separator-dashed mx-5 my-5"></div>

                    <div class="d-flex justify-content-end">

                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                            {{ __('Search') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-base-layout>