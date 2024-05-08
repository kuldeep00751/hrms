<x-base-layout>
    <div class="col-md-6 col-sm-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <a href="/student_charge_types" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Student Charge Types</a>
                </div>
                <div class="pull-right">
                    <h4 class="mt-5 mb-5">Create New Student Charge Type</h4>
                </div>

            </div>
            <form method="POST" action="{{ route('student_charge_types.student_charge_type.store') }}" accept-charset="UTF-8" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {{ csrf_field() }}
                    @include ('pages.settings.student_charge_types.form', [
                    'studentChargeType' => null,
                    ])


                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">
                        <a href="{{ route('student_charge_types.student_charge_type.index') }}" title="Show All Academic Intake">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</x-base-layout>