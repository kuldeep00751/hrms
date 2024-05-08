<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">

            <div class="card-header">

                <span class="pull-left">
                    <h4 class="mt-5 mb-5">Copy Module Allocations</h4>
                </span>
            </div>

            <form method="POST" action="{{ route('assessments.module_allocations.copy') }}" accept-charset="UTF-8" class="form-horizontal">

                <div class="card-body">

                    <div class="alert alert-warning text-black">
                        <strong>Please Note - </strong> All existing module allocation data for the year you are copying to will be deleted and replaced with data from the year you are copying from.
                    </div>

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
                                <select class="form-control" id="from_academic_year_id" name="from_academic_year_id" required>
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
                                <select class="form-control" id="to_academic_year_id" name="to_academic_year_id" required>
                                    @foreach($academicYears as $key => $academicYear)
                                    <option value="{{ $key }}">{{ $academicYear }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">

                        <a href="{{ route('assessments.module_allocations.copyView') }}">
                            Cancel
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-base-layout>