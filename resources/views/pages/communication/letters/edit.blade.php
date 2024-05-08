<x-base-layout>
    <div class="col-md-10 mx-auto">
        <div class="card">

            <div class="card-header clearfix">
                <div class="pull-left">
                    <a href="{{ route('communication.letter.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Letters</a>
                </div>

                <div class="pull-right">
                    <h4 class="mt-5 mb-5">{{ !empty($studentLetter->name) ? $studentLetter->name : 'Student Letter' }}</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('communication.letter.update', $studentLetter->id) }}" accept-charset="UTF-8" class="form-horizontal" id="letter-form">
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
                    @include ('pages.communication.letters.form', [
                    'studentLetter' => $studentLetter,
                    ])

                </div>
                <div class="card-footer">
                    <input class="btn btn-primary" type="submit" value="Update">
                    <a href="{{ route('communication.letter.index') }}">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>