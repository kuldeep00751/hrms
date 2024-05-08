<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">

            <div class="card-header">
                <div class="pull-left">
                    <a href="/exam_registration_criteria" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Exam Registration Criteria</a>
                </div>
                <span class="pull-right">
                    <h4 class="mt-5 mb-5">Create New Exam Registration Criteria</h4>
                </span>

            </div>
            <form method="POST" action="{{ route('exam_registration_criterias.exam_registration_criteria.store') }}" accept-charset="UTF-8" class="form-horizontal">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {{ csrf_field() }}
                    @include ('pages.settings.exam_registration_criterias.form', [
                    'examRegistrationCriteria' => null,
                    ])

                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">
                        <a href="{{ route('exam_registration_criterias.exam_registration_criteria.index') }}" title="Show All Criterias">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>