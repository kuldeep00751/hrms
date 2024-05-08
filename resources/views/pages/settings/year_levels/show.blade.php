@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Year Level' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('year_levels.year_level.destroy', $yearLevel->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('year_levels.year_level.index') }}" class="btn btn-primary" title="Show All Year Level">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('year_levels.year_level.create') }}" class="btn btn-success" title="Create New Year Level">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('year_levels.year_level.edit', $yearLevel->id ) }}" class="btn btn-primary" title="Edit Year Level">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Year Level" onclick="return confirm(&quot;Click Ok to delete Year Level.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Year Level</dt>
            <dd>{{ $yearLevel->year_level }}</dd>

        </dl>

    </div>
</div>

@endsection