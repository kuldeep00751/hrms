@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title->title) ? $title->title : 'Title' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('titles.title.destroy', $title->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('titles.title.index') }}" class="btn btn-primary" title="Show All Title">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('titles.title.create') }}" class="btn btn-success" title="Create New Title">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('titles.title.edit', $title->id ) }}" class="btn btn-primary" title="Edit Title">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Title" onclick="return confirm(&quot;Click Ok to delete Title.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Title</dt>
            <dd>{{ $title->title }}</dd>

        </dl>

    </div>
</div>

@endsection