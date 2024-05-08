<x-base-layout>
    <div class="col-md-8 mx-auto">
        <div class="card">

            <div class="card-header">

                <span class="pull-left">
                    <h4 class="mt-5 mb-5">Create Exam Paper Grading Scale</h4>
                </span>
            </div>
            <form method="POST" action="{{ route('exam_paper_mark_criterias.exam_paper_mark_criteria.store') }}" accept-charset="UTF-8" class="form-horizontal">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif


                    {{ csrf_field() }}
                    @include ('pages.settings.exam_paper_mark_criterias.form', [
                    'examPaperMarkCriterias' => null,
                    'examPaperMarkCriteria' => null,
                    'operation' => 'create'
                    ])

                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">

                        <a href="{{ route('exam_paper_mark_criterias.exam_paper_mark_criteria.index') }}" title="Show All Exam Paper Grading Scales">
                            Cancel
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-base-layout>