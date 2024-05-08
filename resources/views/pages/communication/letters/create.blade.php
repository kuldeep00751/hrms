<x-base-layout>
    <div class="col-md-10 mx-auto">
        <div class="card">

            <div class="card-header clearfix">
                <div class="pull-left">
                    <a href="{{ route('communication.letter.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Letters</a>
                </div>

                <span class="pull-right">
                    <h4 class="mt-5 mb-5">Add New Letter</h4>
                </span>

            </div>
            <form method="POST" action="{{ route('communication.letter.store') }}" accept-charset="UTF-8" class="form-horizontal" id="letter-form">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif


                    {{ csrf_field() }}
                    @include ('pages.communication.letters.form', [
                    'studentLetter' => null,
                    ])
                </div>
                <div class="card-footer">
                    <input class="btn btn-success submit" type="submit" value="Save">
                    <a href="{{ route('communication.letter.index') }}">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>