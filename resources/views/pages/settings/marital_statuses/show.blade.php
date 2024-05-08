@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Study Mode' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('study_modes.study_mode.destroy', $studyMode->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('study_modes.study_mode.index') }}" class="btn btn-primary" title="Show All Study Mode">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('study_modes.study_mode.create') }}" class="btn btn-success" title="Create New Study Mode">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('study_modes.study_mode.edit', $studyMode->id ) }}" class="btn btn-primary" title="Edit Study Mode">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Study Mode" onclick="return confirm(&quot;Click Ok to delete Study Mode.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>Study Mode</dt>
            <dd>{{ $studyMode->study_mode }}</dd>

        </dl>

    </div>
</div>

@endsection