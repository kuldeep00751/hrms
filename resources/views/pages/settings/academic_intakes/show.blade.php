@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($academicIntake->name) ? $academicIntake->name : 'Academic Intake' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('academic_intakes.academic_intake.destroy', $academicIntake->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('academic_intakes.academic_intake.index') }}" class="btn btn-primary" title="Show All Academic Intake">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('academic_intakes.academic_intake.create') }}" class="btn btn-success" title="Create New Academic Intake">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('academic_intakes.academic_intake.edit', $academicIntake->id ) }}" class="btn btn-primary" title="Edit Academic Intake">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Academic Intake" onclick="return confirm(&quot;Click Ok to delete Academic Intake.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Name</dt>
            <dd>{{ $academicIntake->name }}</dd>

        </dl>

    </div>
</div>

@endsection