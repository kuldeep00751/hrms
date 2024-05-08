@extends('layouts.app')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">Grading Scales</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('grading_scales.grading_scale.create') }}" class="btn btn-success" title="Create New Grading Scale">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($gradingScales) == 0)
            <div class="panel-body text-center">
                <h4>No Grading Scales Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Matric Type</th>
                            <th>Subject</th>
                            <th>Symbol</th>
                            <th>Points</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($gradingScales as $gradingScale)
                        <tr>
                            <td>{{ optional($gradingScale->matricType)->matric_type }}</td>
                            <td>{{ optional($gradingScale->subject)->id }}</td>
                            <td>{{ $gradingScale->symbol }}</td>
                            <td>{{ $gradingScale->points }}</td>

                            <td>

                                <form method="POST" action="{!! route('grading_scales.grading_scale.destroy', $gradingScale->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('grading_scales.grading_scale.show', $gradingScale->id ) }}" class="btn btn-info" title="Show Grading Scale">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('grading_scales.grading_scale.edit', $gradingScale->id ) }}" class="btn btn-primary" title="Edit Grading Scale">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Grading Scale" onclick="return confirm(&quot;Click Ok to delete Grading Scale.&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $gradingScales->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection