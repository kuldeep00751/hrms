<x-base-layout>
    <div class="col-md-6 col-sm-12 mx-auto">
        <div class="card">

            <div class="card-header">

                <div class="pull-left">
                    <h4 class="mt-5 mb-5">{{ !empty($registrationStatus->name) ? $registrationStatus->status : 'Registration Status' }}</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('registration_statuses.registration_status.update', $registrationStatus->id) }}" id="edit_registration_status_form" name="edit_registration_status_form" accept-charset="UTF-8" class="form-horizontal">
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
                    @include ('pages.settings.registration_statuses.form', [
                    'registrationStatus' => $registrationStatus,
                    ])



                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Update">
                        <a href="{{ route('registration_statuses.registration_status.index') }}" title="Show All Statuses">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>