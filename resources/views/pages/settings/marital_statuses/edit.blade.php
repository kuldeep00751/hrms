<x-base-layout>
    <div class="col-md-6 mx-auto">

        <div class="card">

            <div class="card-header">

                <div class="pull-left">
                    <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Marital Status' }}</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('marital_statuses.marital_status.update', $maritalStatus->id) }}" accept-charset="UTF-8" class="form-horizontal">
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
                    @include ('pages.settings.marital_statuses.form', [
                    'maritalStatus' => $maritalStatus,
                    ])



                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Update">
                        <a href="{{ route('marital_statuses.marital_status.index') }}">
                            Cancel
                        </a>

                    </div>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>