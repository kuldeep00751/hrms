@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Next Of Kin Relationship' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('next_of_kin_relationships.next_of_kin_relationship.destroy', $nextOfKinRelationship->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('next_of_kin_relationships.next_of_kin_relationship.index') }}" class="btn btn-primary" title="Show All Next Of Kin Relationship">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('next_of_kin_relationships.next_of_kin_relationship.create') }}" class="btn btn-success" title="Create New Next Of Kin Relationship">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('next_of_kin_relationships.next_of_kin_relationship.edit', $nextOfKinRelationship->id ) }}" class="btn btn-primary" title="Edit Next Of Kin Relationship">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Next Of Kin Relationship" onclick="return confirm(&quot;Click Ok to delete Next Of Kin Relationship.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Relationship</dt>
            <dd>{{ $nextOfKinRelationship->relationship }}</dd>

        </dl>

    </div>
</div>

@endsection