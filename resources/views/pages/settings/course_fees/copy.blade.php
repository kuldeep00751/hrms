<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">

            <div class="card-header">

                <span class="pull-left">
                    <h4 class="mt-5 mb-5">Copy Course Fees</h4>
                </span>
            </div>
            <form method="POST" action="{{ route('courseFees.courseFee.copy') }}" accept-charset="UTF-8" id="create_otherFees_form" name="create_otherFees_form" class="form-horizontal">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif


                    {{ csrf_field() }}
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('from_year') ? 'has-error' : '' }}">
                                <label for="from_year" class="control-label">From Year <span class="text-danger">*</span></label>
                                <select class="form-control" id="from_year" name="from_year" required>
                                    @foreach($academicYears as $key => $academicYear)
                                    <option value="{{ $key }}">{{ $academicYear }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('to_year') ? 'has-error' : '' }}">
                                <label for="to_year" class="control-label">To Year <span class="text-danger">*</span></label>
                                <select class="form-control" id="to_year" name="to_year" required>
                                    @foreach($academicYears as $key => $academicYear)
                                    <option value="{{ $key }}">{{ $academicYear }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('increase_type') ? 'has-error' : '' }}">
                                <label for="increase_type" class="control-label">Increase Type <span class="text-danger">*</span></label>
                                <select class="form-control" id="increase_type" name="increase_type" required>
                                    @foreach(\App\Core\Data::getFeeIncreaseTypes() as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('increase_percentage') ? 'has-error' : '' }}">
                                <label for="increase_percentage" class="control-label">Increase by <span class="text-danger">*</span></label>
                                <select class="form-control" id="increase_percentage" name="increase_percentage" required>
                                    @foreach(\App\Core\Data::getPercentages() as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('increase_by') ? 'has-error' : '' }}">
                                <label for="amount" class="control-label">Increase Amount (N$) <span class="text-danger">*</span></label>
                                <input class="form-control" name="increase_by" type="number" id="increase_by" value="{{ old('increase_by') }}">
                                <input class="form-control" name="created_by" type="hidden" id="created_by" value="{{ auth()->user()->id }}">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Copy">

                        <a href="{{ route('otherFees.otherFee.index') }}" title="Show All Fees">
                            Cancel
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-base-layout>