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
                <h4 class="mt-5 mb-5">Qualification Subjects</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('qualification_subjects.qualification_subject.create') }}" class="btn btn-success" title="Create New Qualification Subject">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($qualificationSubjects) == 0)
            <div class="panel-body text-center">
                <h4>No Qualification Subjects Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Qualification</th>
                            <th>Subject</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($qualificationSubjects as $qualificationSubject)
                        <tr>
                            <td>{{ optional($qualificationSubject->qualification)->qualification_name }}</td>
                            <td>{{ optional($qualificationSubject->subject)->id }}</td>

                            <td>

                                <form method="POST" action="{!! route('qualification_subjects.qualification_subject.destroy', $qualificationSubject->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('qualification_subjects.qualification_subject.show', $qualificationSubject->id ) }}" class="btn btn-info" title="Show Qualification Subject">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('qualification_subjects.qualification_subject.edit', $qualificationSubject->id ) }}" class="btn btn-primary" title="Edit Qualification Subject">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Qualification Subject" onclick="return confirm(&quot;Click Ok to delete Qualification Subject.&quot;)">
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
            {!! $qualificationSubjects->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection