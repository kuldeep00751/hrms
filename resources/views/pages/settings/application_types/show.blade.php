@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Application Type' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('application_types.application_type.destroy', $applicationType->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('application_types.application_type.index') }}" class="btn btn-primary" title="Show All Application Type">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('application_types.application_type.create') }}" class="btn btn-success" title="Create New Application Type">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('application_types.application_type.edit', $applicationType->id ) }}" class="btn btn-primary" title="Edit Application Type">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Application Type" onclick="return confirm(&quot;Click Ok to delete Application Type.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Application Type</dt>
            <dd>{{ $applicationType->application_type }}</dd>

        </dl>

    </div>
</div>

@endsection