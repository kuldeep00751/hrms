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
                <h4 class="mt-5 mb-5">Subject Study Periods</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('subject_study_periods.subject_study_period.create') }}" class="btn btn-success" title="Create New Subject Study Period">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($subjectStudyPeriods) == 0)
            <div class="panel-body text-center">
                <h4>No Subject Study Periods Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Study Period</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($subjectStudyPeriods as $subjectStudyPeriod)
                        <tr>
                            <td>{{ optional($subjectStudyPeriod->subject)->id }}</td>
                            <td>{{ optional($subjectStudyPeriod->studyPeriod)->id }}</td>

                            <td>

                                <form method="POST" action="{!! route('subject_study_periods.subject_study_period.destroy', $subjectStudyPeriod->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('subject_study_periods.subject_study_period.show', $subjectStudyPeriod->id ) }}" class="btn btn-info" title="Show Subject Study Period">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('subject_study_periods.subject_study_period.edit', $subjectStudyPeriod->id ) }}" class="btn btn-primary" title="Edit Subject Study Period">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Subject Study Period" onclick="return confirm(&quot;Click Ok to delete Subject Study Period.&quot;)">
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
            {!! $subjectStudyPeriods->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection