<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">

            <div class="card-header clearfix">

                <div class="pull-left">
                    <h4 class="mt-5 mb-5">{{ !empty($academicYear->name) ? $academicYear->name : 'Academic Year' }}</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('academic_years.academic_year.update', $academicYear->id) }}" id="edit_academic_year_form" name="edit_academic_year_form" accept-charset="UTF-8" class="form-horizontal">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif


                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PUT">
                    @include ('pages.settings.academic_years.form', [
                    'academicYear' => $academicYear,
                    ])



                </div>
                <div class="card-footer">
                    <input class="btn btn-primary" type="submit" value="Update">
                    <a href="{{ route('academic_years.academic_year.index') }}" title="Show All Academic Intake">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>