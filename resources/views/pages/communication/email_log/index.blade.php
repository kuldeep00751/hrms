<x-base-layout>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <div class="pull-left">
                        <strong>Student Email Logs</strong>
                    </div>
                </div>
                <div class="card-body">
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