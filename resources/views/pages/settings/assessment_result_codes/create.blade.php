<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">

            <div class="card-header">

                <span class="pull-left">
                    <h4 class="mt-5 mb-5">Create Assessment Result Code</h4>
                </span>
            </div>
            <form method="POST" action="{{ route('assessment_result_codes.assessment_result_code.store') }}" accept-charset="UTF-8" class="form-horizontal">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif


                    {{ csrf_field() }}
                    @include ('pages.settings.assessment_result_codes.form', [
                    'assessmentResultCode' => null,
                    ])

                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">

                        <a href="{{ route('assessment_result_codes.assessment_result_code.index') }}" title="Show All Result Codes">
                            Cancel
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-base-layout>