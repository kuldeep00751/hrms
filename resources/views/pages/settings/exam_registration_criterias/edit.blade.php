<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">

            <div class="card-header clearfix">
                <div class="pull-left">
                    <a href="/exam_registration_criteria" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Exam Registration Criteria</a>
                </div>
                <span class="pull-right">
                    <h4 class="mt-5 mb-5">Exam Registration Criteria</h4>
                </span>
            </div>
            <form method="POST" action="{{ route('exam_registration_criterias.exam_registration_criteria.update', $examRegistrationCriteria->id) }}" accept-charset="UTF-8" class="form-horizontal">
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
                    @include ('pages.settings.exam_registration_criterias.form', [
                    'examRegistrationCriteria' => $examRegistrationCriteria,
                    ])

                </div>
                <div class="card-footer">
                    <input class="btn btn-primary" type="submit" value="Update">
                    <a href="{{ route('exam_registration_criterias.exam_registration_criteria.index') }}" title="Show All Criterias">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>