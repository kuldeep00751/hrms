@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Matric Type' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('matric_types.matric_type.destroy', $matricType->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('matric_types.matric_type.index') }}" class="btn btn-primary" title="Show All Matric Type">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('matric_types.matric_type.create') }}" class="btn btn-success" title="Create New Matric Type">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('matric_types.matric_type.edit', $matricType->id ) }}" class="btn btn-primary" title="Edit Matric Type">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Matric Type" onclick="return confirm(&quot;Click Ok to delete Matric Type.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Matric Type</dt>
            <dd>{{ $matricType->matric_type }}</dd>

        </dl>

    </div>
</div>

@endsection