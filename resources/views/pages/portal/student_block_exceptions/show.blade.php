@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Academic Process' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('academic_processes.academic_process.destroy', $academicProcess->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('academic_processes.academic_process.index') }}" class="btn btn-primary" title="Show All Academic Process">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('academic_processes.academic_process.create') }}" class="btn btn-success" title="Create New Academic Process">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('academic_processes.academic_process.edit', $academicProcess->id ) }}" class="btn btn-primary" title="Edit Academic Process">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Academic Process" onclick="return confirm(&quot;Click Ok to delete Academic Process.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Process Name</dt>
            <dd>{{ $academicProcess->process_name }}</dd>
            <dt>Start Date</dt>
            <dd>{{ $academicProcess->start_date }}</dd>
            <dt>End Date</dt>
            <dd>{{ $academicProcess->end_date }}</dd>

        </dl>

    </div>
</div>

@endsection