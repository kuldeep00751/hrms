<x-base-layout>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <div class="pull-left">
                        <strong>Student Biographical Information</strong>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('user_infos.user_info.create') }}" class="btn btn-sm btn-primary">
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
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <i class="fa-solid fa-circle-xmark text-danger"></i>
                        {{ $error }}
                        @endforeach
                    </ul>
                    @endif
                    <div class="table-responsive">

                        {{$dataTable->table()}}

                        {{-- Inject Scripts --}}
                        @section('scripts')
                        {{ $dataTable->scripts() }}
                        @endsection

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base-layout>