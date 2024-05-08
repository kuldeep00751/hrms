@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Required Document' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('required_documents.required_document.destroy', $requiredDocument->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('required_documents.required_document.index') }}" class="btn btn-primary" title="Show All Required Document">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('required_documents.required_document.create') }}" class="btn btn-success" title="Create New Required Document">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('required_documents.required_document.edit', $requiredDocument->id ) }}" class="btn btn-primary" title="Edit Required Document">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Required Document" onclick="return confirm(&quot;Click Ok to delete Required Document.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Document Name</dt>
            <dd>{{ $requiredDocument->document_name }}</dd>
            <dt>Is Required</dt>
            <dd>{{ ($requiredDocument->is_required) ? 'Yes' : 'No' }}</dd>

        </dl>

    </div>
</div>

@endsection