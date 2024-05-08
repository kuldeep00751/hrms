@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Qualification Subject' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('qualification_subjects.qualification_subject.destroy', $qualificationSubject->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('qualification_subjects.qualification_subject.index') }}" class="btn btn-primary" title="Show All Qualification Subject">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('qualification_subjects.qualification_subject.create') }}" class="btn btn-success" title="Create New Qualification Subject">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('qualification_subjects.qualification_subject.edit', $qualificationSubject->id ) }}" class="btn btn-primary" title="Edit Qualification Subject">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Qualification Subject" onclick="return confirm(&quot;Click Ok to delete Qualification Subject.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Qualification</dt>
            <dd>{{ optional($qualificationSubject->qualification)->qualification_name }}</dd>
            <dt>Subject</dt>
            <dd>{{ optional($qualificationSubject->subject)->id }}</dd>

        </dl>

    </div>
</div>

@endsection