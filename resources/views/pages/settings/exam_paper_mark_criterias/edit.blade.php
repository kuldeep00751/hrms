<x-base-layout>
    <div class="col-md-8 mx-auto">
        <div class="card">

            <div class="card-header">

                <div class="pull-left">
                    <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Exam Paper Grading Scale' }}</h4>
                </div>

            </div>
            <form method="POST" action="{{ route('exam_paper_mark_criterias.exam_paper_mark_criteria.update', 1) }}" accept-charset="UTF-8" class="form-horizontal">
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
                    <input name="module_id" type="hidden" value="{{ $examPaperMarkCriterias->first()->module_id}}">
                    <input name="academic_year_id" type="hidden" value="{{ $examPaperMarkCriterias->first()->academic_year_id}}">
                    <input name="assessment_type_id" type="hidden" value="{{ $examPaperMarkCriterias->first()->assessment_type_id}}">
                    @include ('pages.settings.exam_paper_mark_criterias.form', [
                    'examPaperMarkCriterias' => $examPaperMarkCriterias,
                    'examPaperMarkCriteria' => $examPaperMarkCriterias->first(),
                    'operation' => 'edit'
                    ])
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Update">
                        <a href="{{ route('exam_paper_mark_criterias.exam_paper_mark_criteria.index') }}" title="Show All Grading Scales">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>