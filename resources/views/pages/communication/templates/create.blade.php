<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">

            <div class="card-header clearfix">
                <div class="pull-left">
                    <a href="{{ route('communication.pdf-template.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Templates</a>
                </div>

                <span class="pull-right">
                    <h4 class="mt-5 mb-5">Add New Template Document</h4>
                </span>

            </div>
            <form method="POST" action="{{ route('communication.pdf-template.store') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif


                    {{ csrf_field() }}
                    @include ('pages.communication.templates.form', [
                    'documentTemplate' => null,
                    ])
                </div>
                <div class="card-footer">
                    <input class="btn btn-success" type="submit" value="Save">
                    <a href="{{ route('communication.pdf-template.index') }}">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>