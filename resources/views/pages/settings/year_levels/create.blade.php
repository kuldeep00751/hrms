<x-base-layout>
    <div class="col-md-6 mx-auto">

        <div class="card">
            <div class="card-header">

                <span class="pull-left">
                    <h4 class="mt-5 mb-5">Create New Year Level</h4>
                </span>

            </div>

            <div class="card-body">

                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <form method="POST" action="{{ route('year_levels.year_level.store') }}" accept-charset="UTF-8" id="create_year_level_form" name="create_year_level_form" class="form-horizontal">
                    {{ csrf_field() }}
                    @include ('pages.settings.year_levels.form', [
                    'yearLevel' => null,
                    ])




            </div>
            <div class="card-footer">
                <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Add">
                    <a href="{{ route('year_levels.year_level.index') }}"  title="Show All Year Level">
                        Cancel
                    </a>
                </div>
            </div>
            </form>
        </div>
    </div>
</x-base-layout>