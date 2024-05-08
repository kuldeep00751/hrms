<x-base-layout>
    <div class="col-md-6 mx-auto">

        <div class="card">
            <div class="card-header">

                <span class="pull-left">
                    <h4 class="mt-5 mb-5">Create New Required Documentation</h4>
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

                <form method="POST" action="{{ route('required_documents.required_document.store') }}" accept-charset="UTF-8" class="form-horizontal">
                    {{ csrf_field() }}
                    @include ('pages.settings.required_documents.form', [
                    'requiredDocument' => null,
                    ])

            </div>
            <div class="card-footer">
                <div class="form-group">
                    <input class="btn btn-success" type="submit" value="Save">
                    <a href="{{ route('required_documents.required_document.index') }}" title="Show All Documents">
                        Cancel
                    </a>
                </div>
            </div>
            </form>
        </div>
    </div>
</x-base-layout>