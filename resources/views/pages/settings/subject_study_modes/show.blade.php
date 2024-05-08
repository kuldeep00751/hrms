@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Subject Study Mode' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('subject_study_modes.subject_study_mode.destroy', $subjectStudyMode->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('subject_study_modes.subject_study_mode.index') }}" class="btn btn-primary" title="Show All Subject Study Mode">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('subject_study_modes.subject_study_mode.create') }}" class="btn btn-success" title="Create New Subject Study Mode">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('subject_study_modes.subject_study_mode.edit', $subjectStudyMode->id ) }}" class="btn btn-primary" title="Edit Subject Study Mode">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Subject Study Mode" onclick="return confirm(&quot;Click Ok to delete Subject Study Mode.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Subject</dt>
            <dd>{{ optional($subjectStudyMode->subject)->id }}</dd>
            <dt>Study Mode</dt>
            <dd>{{ optional($subjectStudyMode->studyMode)->study_mode }}</dd>

        </dl>

    </div>
</div>

@endsection