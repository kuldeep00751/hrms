<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">

            <div class="card-header">

                <span class="pull-left">
                    <h4 class="mt-5 mb-5">Create New Matric Type</h4>
                </span>

            </div>
            <form method="POST" action="{{ route('matric_types.matric_type.store') }}" accept-charset="UTF-8" id="create_matric_type_form" name="create_matric_type_form" class="form-horizontal">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif


                    {{ csrf_field() }}
                    @include ('pages.settings.matric_types.form', [
                    'matricType' => null,
                    ])
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">

                        <a href="{{ route('matric_types.matric_type.index') }}" title="Show All Matric Type">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
</x-base-layout>