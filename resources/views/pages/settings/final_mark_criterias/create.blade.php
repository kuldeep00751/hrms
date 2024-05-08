<x-base-layout>
    <div class="col-md-8 mx-auto">
        <div class="card">

            <div class="card-header">
                <div class="pull-left">
                    <a href="/final_mark_criterias" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Final Mark Gradings </a>
                </div>
                <span class="pull-right">
                    <h4 class="mt-5 mb-5">Create Final Mark Grading Scale</h4>
                </span>
            </div>
            <form method="POST" action="{{ route('final_mark_criterias.final_mark_criteria.store') }}" accept-charset="UTF-8" class="form-horizontal">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif


                    {{ csrf_field() }}
                    @include ('pages.settings.final_mark_criterias.form', [
                    'finalMarkCriterias' => null,
                    'finalMarkCriteria' => null,
                    'operation' => 'create'
                    ])

                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">

                        <a href="{{ route('final_mark_criterias.final_mark_criteria.index') }}" title="Show All Final Mark Grading Scales">
                            Cancel
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-base-layout>