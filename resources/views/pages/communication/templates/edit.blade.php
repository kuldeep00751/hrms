<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">

            <div class="card-header clearfix">
                <div class="pull-left">
                    <a href="{{ route('communication.pdf-template.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Templates</a>
                </div>

                <div class="pull-right">
                    <h4 class="mt-5 mb-5">{{ !empty($documentTemplate->name) ? $documentTemplate->name : 'Document Template' }}</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('communication.pdf-template.update', $documentTemplate->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
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
                    @include ('pages.communication.templates.form', [
                    'documentTemplate' => $documentTemplate,
                    ])

                </div>
                <div class="card-footer">
                    <input class="btn btn-primary" type="submit" value="Update">
                    <a href="{{ route('communication.pdf-template.index') }}">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>