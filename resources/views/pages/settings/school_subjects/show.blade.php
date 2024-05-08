@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'School Subject' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('school_subjects.school_subject.destroy', $schoolSubject->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('school_subjects.school_subject.index') }}" class="btn btn-primary" title="Show All School Subject">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('school_subjects.school_subject.create') }}" class="btn btn-success" title="Create New School Subject">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('school_subjects.school_subject.edit', $schoolSubject->id ) }}" class="btn btn-primary" title="Edit School Subject">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete School Subject" onclick="return confirm(&quot;Click Ok to delete School Subject.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Subject Name</dt>
            <dd>{{ $schoolSubject->subject_name }}</dd>

        </dl>

    </div>
</div>

@endsection