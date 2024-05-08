<x-base-layout>
    <div class="col-md-6 mx-auto">

        <div class="card">


            <div class="card-header">

                <span class="pull-left">
                    <h4 class="mt-5 mb-5">Create New Study Period</h4>
                </span>

            </div>
            <form method="POST" action="{{ route('study_periods.study_period.store') }}" accept-charset="UTF-8" id="create_study_period_form" name="create_study_period_form" class="form-horizontal">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif


                    {{ csrf_field() }}
                    @include ('pages.settings.study_periods.form', [
                    'studyPeriod' => null,
                    ])
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">
                        <a href="{{ route('study_periods.study_period.index') }}"  title="Show All Study Period">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</x-base-layout>