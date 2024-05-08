<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">

            <div class="card-header">

                <span class="pull-left">
                    <h4 class="mt-5 mb-5">Create New Exam Admission Criteria</h4>
                </span>

            </div>
            <form method="POST" action="{{ route('exam_admission_criterias.exam_admission_criteria.store') }}" accept-charset="UTF-8" class="form-horizontal">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif


                    {{ csrf_field() }}
                    @include ('pages.settings.exam_admission_criterias.form', [
                    'examAdmissionCriteria' => null,
                    ])




                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">
                        <a href="{{ route('exam_admission_criterias.exam_admission_criteria.index') }}" title="Show All Criterias">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
</x-base-layout>