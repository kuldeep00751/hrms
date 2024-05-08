<x-base-layout>
    <div class="col-md-8 col-sm-12 mx-auto">
        <div class="card">
            <div class="card-header clearfix">
                <h4 class="mt-5 mb-5">Create CA Weight</h4>
            </div>
            <form method="POST" action="{{ route('continuous_assessments.continuous_assessment.store') }}" accept-charset="UTF-8" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {{ csrf_field() }}
                    @include ('pages.settings.continuous_assessments.form', [
                    'continuousAssessment' => null,
                    ])

                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">
                        <a href="{{ route('continuous_assessments.continuous_assessment.index') }}" title="Show CA Weights">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</x-base-layout>