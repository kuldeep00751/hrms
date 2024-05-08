@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Qualification Campus' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('qualification_campuses.qualification_campus.destroy', $qualificationCampus->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('qualification_campuses.qualification_campus.index') }}" class="btn btn-primary" title="Show All Qualification Campus">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('qualification_campuses.qualification_campus.create') }}" class="btn btn-success" title="Create New Qualification Campus">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('qualification_campuses.qualification_campus.edit', $qualificationCampus->id ) }}" class="btn btn-primary" title="Edit Qualification Campus">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Qualification Campus" onclick="return confirm(&quot;Click Ok to delete Qualification Campus.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Campus</dt>
            <dd>{{ optional($qualificationCampus->campus)->name }}</dd>
            <dt>Qualification</dt>
            <dd>{{ optional($qualificationCampus->qualification)->qualification_name }}</dd>

        </dl>

    </div>
</div>

@endsection