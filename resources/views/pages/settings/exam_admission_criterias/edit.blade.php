<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">

            <div class="card-header clearfix">

                <div class="pull-left">
                    <h4 class="mt-5 mb-5">{{ !empty($examAdmissionCriteria->module->module_name) ? $examAdmissionCriteria->module->module_name : 'Exam Admission Criteria' }}</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('exam_admission_criterias.exam_admission_criteria.update', $examAdmissionCriteria->id) }}" accept-charset="UTF-8" class="form-horizontal">
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
                    @include ('pages.settings.exam_admission_criterias.form', [
                    'examAdmissionCriteria' => $examAdmissionCriteria,
                    ])



                </div>
                <div class="card-footer">
                    <input class="btn btn-primary" type="submit" value="Update">
                    <a href="{{ route('exam_admission_criterias.exam_admission_criteria.index') }}" title="Show All Criterias">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>