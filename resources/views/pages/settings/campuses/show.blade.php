@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($campus->name) ? $campus->name : 'Campus' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('campuses.campus.destroy', $campus->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('campuses.campus.index') }}" class="btn btn-primary" title="Show All Campus">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('campuses.campus.create') }}" class="btn btn-success" title="Create New Campus">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('campuses.campus.edit', $campus->id ) }}" class="btn btn-primary" title="Edit Campus">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Campus" onclick="return confirm(&quot;Click Ok to delete Campus.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Name</dt>
            <dd>{{ $campus->name }}</dd>
            <dt>Address Line 1</dt>
            <dd>{{ $campus->address_line_1 }}</dd>
            <dt>Address Line 2</dt>
            <dd>{{ $campus->address_line_2 }}</dd>
            <dt>Address Line 3</dt>
            <dd>{{ $campus->address_line_3 }}</dd>

        </dl>

    </div>
</div>

@endsection