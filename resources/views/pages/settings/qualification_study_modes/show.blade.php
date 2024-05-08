@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Qualification Study Mode' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('qualification_study_modes.qualification_study_mode.destroy', $qualificationStudyMode->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('qualification_study_modes.qualification_study_mode.index') }}" class="btn btn-primary" title="Show All Qualification Study Mode">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('qualification_study_modes.qualification_study_mode.create') }}" class="btn btn-success" title="Create New Qualification Study Mode">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('qualification_study_modes.qualification_study_mode.edit', $qualificationStudyMode->id ) }}" class="btn btn-primary" title="Edit Qualification Study Mode">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Qualification Study Mode" onclick="return confirm(&quot;Click Ok to delete Qualification Study Mode.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Qualification</dt>
            <dd>{{ optional($qualificationStudyMode->qualification)->qualification_name }}</dd>
            <dt>Study Mode</dt>
            <dd>{{ optional($qualificationStudyMode->studyMode)->id }}</dd>

        </dl>

    </div>
</div>

@endsection