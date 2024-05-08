<x-base-layout>
    <div class="col-md-12">

        <div class="card">

            <div class="card-header">

                <h4>Users</h4>

                <div class="pull-right">
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary" title="Create New Study Period">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                </div>

            </div>
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
                    {{ $dataTable->table() }}
                    {{-- Inject Scripts --}}
                    @section('scripts')
                    {{ $dataTable->scripts() }}
                    @endsection

                </div>
            </div>
        </div>
    </div>
</x-base-layout>