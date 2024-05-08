@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Education System' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('education_systems.education_system.destroy', $educationSystem->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('education_systems.education_system.index') }}" class="btn btn-primary" title="Show All Education System">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('education_systems.education_system.create') }}" class="btn btn-success" title="Create New Education System">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('education_systems.education_system.edit', $educationSystem->id ) }}" class="btn btn-primary" title="Edit Education System">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Education System" onclick="return confirm(&quot;Click Ok to delete Education System.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>System Name</dt>
            <dd>{{ $educationSystem->system_name }}</dd>

        </dl>

    </div>
</div>

@endsection