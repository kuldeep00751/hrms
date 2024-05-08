<x-base-layout>
    <div class="col-md-8 mx-auto">

        <div class="card">
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <h6>Document Templates</h6>
                    </div>

                    <div class="pull-right" role="group">
                        <a href="{{ route('communication.pdf-template.create') }}" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-plus"></i> Add New
                        </a>
                    </div>
                </div>

                @if(count($documentTemplates) == 0)
                <div class="card-body text-center">
                    <h4>No templates Available.</h4>
                </div>
                @else
                <div class="card-body">
                    @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <h6 class="text-success">
                            <i class="fa-solid fa-circle-check text-success"></i>
                            {!! session('success_message') !!}
                        </h6>
                    </div>
                    @endif
                    <div class="table-responsive">

                        <table class="table table-row-dashed">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Name</th>
                                    <th>Document</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documentTemplates as $documentTemplate)
                                <tr>
                                    <td>{{ $documentTemplate->name }}</td>
                                    <td>{{ $documentTemplate->template_path }}</td>

                                    <td>
                                        <a href="{{ route('communication.pdf-template.edit', $documentTemplate->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
                                        <a href="{{ route('communication.pdf-template.delete', $documentTemplate->id ) }}" class="btn btn-sm btn-light btn-active-light-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</x-base-layout>