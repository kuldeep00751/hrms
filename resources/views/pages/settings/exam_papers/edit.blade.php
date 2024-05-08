<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">

            <div class="card-header">
                <div class="pull-left">
                    <a href="/exam_papers" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Exam Papers</a>
                </div>
                <div class="pull-right">
                    <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Exam Papers' }}</h4>
                </div>

            </div>
            <form method="POST" action="{{ route('exam_papers.exam_paper.update', $examPaper->id) }}" accept-charset="UTF-8" class="form-horizontal" id="exam_papers_form">
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
                    @include ('pages.settings.exam_papers.form', [
                    'examPaper' => $examPaper,
                    ])
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Update" id="exam_papers_button">
                        <a href="{{ route('exam_papers.exam_paper.index') }}" title="Show All Papers">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-base-layout>