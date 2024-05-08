<x-base-layout>
    <div class="col-md-12 mx-auto">

        <div class="card">
            <div class="card-header">

                <div class="pull-left">
                    <h6>Qualification Registrations</h6>
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
                    {!! $error !!}
                    @endforeach
                </ul>
                @endif
                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
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