<x-base-layout>
    <div class="col-md-6 col-sm-12 mx-auto">
        <div class="card">
            <div class="card-header clearfix">
                <h4 class="mt-5 mb-5">Create New Assessment Mark Type</h4>
            </div>
            <form method="POST" action="{{ route('mark_types.mark_type.store') }}" accept-charset="UTF-8" id="create_mark_types_form" name="create_mark_types_form" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {{ csrf_field() }}
                    @include ('pages.settings.mark_types.form', [
                    'markType' => null,
                    ])


                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">
                        <a href="{{ route('mark_types.mark_type.index') }}" title="Show All Mark Types">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</x-base-layout>