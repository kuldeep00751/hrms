<x-base-layout>
    <div class="col-md-10 mx-auto">
        <form method="POST" action="{{ route('lovs.lov.update') }}" id="edit_lov_form" name="edit_lov_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
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
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif

            <div class="card mb-5">
                <div class="card-header">
                    <div class="pull-left">
                        <a href="/system/settings#general" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="mb-5 text-gray-400 fw-bold text-uppercase">Academic Applications</h6>
                    <div class="row mb-5">
                        @php
                        $allowed_academic_applications = $lovs->where('label', 'ALLOWED_NUMBER_OF_ACADEMIC_APPLICATIONS')->first();

                        @endphp
                        <label class="mb-3"><strong>How many applications are allowed per student per year?</strong></label>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <input class="form-control" name="ALLOWED_NUMBER_OF_ACADEMIC_APPLICATIONS" type="number" id="allowed_academic_applications" value="{{ old('allowed_academic_applications', $allowed_academic_applications->value) }}">
                            </div>
                        </div>
                    </div>
                    <div class="separator separator-dashed mx-5 my-5"></div>
                    <h6 class="mb-5 text-gray-400 fw-bold text-uppercase">Student Enrolment Charge Type</h6>
                    <div class="row mb-5">
                        <label class="mb-3"><strong>How do you charge students for enrolment?</strong></label>
                        <div class="col-md-6 col-sm-12">
                            @php
                            $charge_type = $lovs->where('label', 'REGISTRATION_FEE_CHARGE_TYPE')->first();
                            @endphp
                            <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                                <select class="form-control" id="charge-types" name="REGISTRATION_FEE_CHARGE_TYPE">
                                    @foreach ($chargeTypes as $key => $chargeType)
                                    <option value="{{ $key }}" {{ ($key == $charge_type->value) ? 'selected' : ''}}>
                                        {{ $chargeType }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-body">
                    <h6 class="mb-5 text-gray-400 fw-bold text-uppercase">Student Application Acknowledgement Letter</h6>
                    <div class="alert alert-warning text-black">
                        <p>
                            The system can send acknowledgement letters immediately after a student submits an application for a qualification. Please select the letter which should be sent out below.
                        </p>

                        <p>
                            <strong>All letters are defined under the communication module.</strong>
                        </p>
                    </div>
                    <div class="row mb-5">
                        <label class="mb-3"><strong>Would you like to send an email of student acknowledgement letters immediately after they submit a new application?</strong></label>
                        <div class="col-md-6 col-sm-12">
                            @php
                            $acknowledgement_letter_option = $lovs->where('label', 'SEND_ACKNOWLEDGEMENT_LETTER')->first() ?? '';
                            @endphp
                            <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                                <select class="form-control" id="acknowledgement-letter-option" name="SEND_ACKNOWLEDGEMENT_LETTER">
                                    <option></option>
                                    @foreach ($acknowledgementLetterOptions as $key => $acknowledgementLetterOption)
                                    <option value="{{ $key }}" {{ ($key == optional($acknowledgement_letter_option)->value) ? 'selected' : ''}}>
                                        {{ $acknowledgementLetterOption }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <label class="mb-3"><strong>If yes, please select the letter to be sent out?</strong></label>
                        <div class="col-md-6 col-sm-12">
                            @php
                            $acknowledgement_letter = $lovs->where('label', 'ACKNOWLEDGEMENT_LETTER_ID')->first() ?? '';
                            @endphp
                            <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                                <select class="form-control" id="acknowledgement-letter-option" name="ACKNOWLEDGEMENT_LETTER_ID">
                                    <option></option>
                                    @foreach ($acknowledgementLetters as $key => $acknowledgementLetter)
                                    <option value="{{ $key }}" {{ ($key == optional($acknowledgement_letter)->value) ? 'selected' : ''}}>
                                        {{ $acknowledgementLetter }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">

                        <a href="{{ route('lovs.lov.index') }}">
                            Cancel
                        </a>
                    </div>

                </div>

            </div>

        </form>
    </div>
</x-base-layout>