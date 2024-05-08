<x-base-layout>
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <a href="{{ route('assessments.my_modules.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> My Modules </a>
                </div>
                <div class="pull-right">
                    <a href="{{ route('assessments.my_modules.download-classlist', $moduleAllocation->id) }}" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-download"></i> Download Class list
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

                @if(!count($moduleRegistrations))
                <div class="alert alert-danger">
                    There are no students registered for this module.
                </div>
                @else
                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">
                        
                        @include('pages.assessments.my_modules.classlist-table', ['moduleRegistrations' => $moduleRegistrations])

                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-base-layout>