@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Gender Type' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('gender_types.gender_type.destroy', $genderType->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('gender_types.gender_type.index') }}" class="btn btn-primary" title="Show All Gender Type">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('gender_types.gender_type.create') }}" class="btn btn-success" title="Create New Gender Type">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('gender_types.gender_type.edit', $genderType->id ) }}" class="btn btn-primary" title="Edit Gender Type">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Gender Type" onclick="return confirm(&quot;Click Ok to delete Gender Type.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Gender Type</dt>
            <dd>{{ $genderType->gender_type }}</dd>

        </dl>

    </div>
</div>

@endsection