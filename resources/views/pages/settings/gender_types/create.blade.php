<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">

            <div class="card-header">

                <span class="pull-left">
                    <h4 class="mt-5 mb-5">Create New Gender Type</h4>
                </span>

                <div class="btn-group btn-group-sm pull-right" role="group">

                </div>

            </div>
            <form method="POST" action="{{ route('gender_types.gender_type.store') }}" accept-charset="UTF-8" id="create_gender_type_form" name="create_gender_type_form" class="form-horizontal">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif


                    {{ csrf_field() }}
                    @include ('pages.settings.gender_types.form', [
                    'genderType' => null,
                    ])




                </div>
                <div class="card-footer">
                    <div class="form-group">
                            <input class="btn btn-success" type="submit" value="Save">
                            <a href="{{ route('gender_types.gender_type.index') }}" title="Show All Gender Type">
                                Cancel
                            </a>
                    </div>
                </div>
            </form>
        </div>

</x-base-layout>