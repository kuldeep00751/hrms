@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Subject Study Period' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('subject_study_periods.subject_study_period.destroy', $subjectStudyPeriod->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('subject_study_periods.subject_study_period.index') }}" class="btn btn-primary" title="Show All Subject Study Period">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('subject_study_periods.subject_study_period.create') }}" class="btn btn-success" title="Create New Subject Study Period">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('subject_study_periods.subject_study_period.edit', $subjectStudyPeriod->id ) }}" class="btn btn-primary" title="Edit Subject Study Period">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Subject Study Period" onclick="return confirm(&quot;Click Ok to delete Subject Study Period.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Subject</dt>
            <dd>{{ optional($subjectStudyPeriod->subject)->id }}</dd>
            <dt>Study Period</dt>
            <dd>{{ optional($subjectStudyPeriod->studyPeriod)->id }}</dd>

        </dl>

    </div>
</div>

@endsection