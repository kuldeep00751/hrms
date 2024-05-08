<x-base-layout>
    <div class="col-md-6 col-sm-12 mx-auto">
        <div class="card">

            <div class="card-header">
                <div class="pull-left">
                    <a href="/academic_intakes" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Academic Intakes</a>
                </div>
                <div class="pull-right">
                    <h4 class="mt-5 mb-5">{{ !empty($academicIntake->name) ? $academicIntake->name : 'Academic Intake' }}</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('academic_intakes.academic_intake.update', $academicIntake->id) }}" id="edit_academic_intake_form" name="edit_academic_intake_form" accept-charset="UTF-8" class="form-horizontal">
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
                    @include ('pages.settings.academic_intakes.form', [
                    'academicIntake' => $academicIntake,
                    ])



                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Update">
                        <a href="{{ route('academic_intakes.academic_intake.index') }}" title="Show All Academic Intake">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>