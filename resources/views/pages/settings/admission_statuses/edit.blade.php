<x-base-layout>
    <div class="col-md-6 col-sm-12 mx-auto">
        <div class="card">

            <div class="card-header">

                <div class="pull-left">
                    <h4 class="mt-5 mb-5">{{ !empty($admissionStatus->name) ? $admissionStatus->status : 'Admission Status' }}</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('admission_statuses.admission_status.update', $admissionStatus->id) }}" id="edit_admission_status_form" name="edit_admission_status_form" accept-charset="UTF-8" class="form-horizontal">
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
                    @include ('pages.settings.admission_statuses.form', [
                    'admissionStatus' => $admissionStatus,
                    ])



                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Update">
                        <a href="{{ route('admission_statuses.admission_status.index') }}" title="Show All Admission Statuses">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>