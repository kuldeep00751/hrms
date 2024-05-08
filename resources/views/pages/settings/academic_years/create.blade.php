<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">

            <div class="card-header clearfix">

                <span class="pull-left">
                    <h4 class="mt-5 mb-5">Create New Academic Year</h4>
                </span>

            </div>
            <form method="POST" action="{{ route('academic_years.academic_year.store') }}" accept-charset="UTF-8" id="create_academic_year_form" name="create_academic_year_form" class="form-horizontal">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif


                    {{ csrf_field() }}
                    @include ('pages.settings.academic_years.form', [
                    'academicYear' => null,
                    ])
                </div>
                <div class="card-footer">
                    <input class="btn btn-success" type="submit" value="Save">
                    <a href="{{ route('academic_years.academic_year.index') }}" title="Show All Academic Intake">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>