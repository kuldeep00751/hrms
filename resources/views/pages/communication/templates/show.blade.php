@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($academicYear->name) ? $academicYear->name : 'Academic Year' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('academic_years.academic_year.destroy', $academicYear->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('academic_years.academic_year.index') }}" class="btn btn-primary" title="Show All Academic Year">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('academic_years.academic_year.create') }}" class="btn btn-success" title="Create New Academic Year">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('academic_years.academic_year.edit', $academicYear->id ) }}" class="btn btn-primary" title="Edit Academic Year">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Academic Year" onclick="return confirm(&quot;Click Ok to delete Academic Year.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Name</dt>
            <dd>{{ $academicYear->name }}</dd>
            <dt>Start</dt>
            <dd>{{ $academicYear->start }}</dd>
            <dt>End</dt>
            <dd>{{ $academicYear->end }}</dd>

        </dl>

    </div>
</div>

@endsection