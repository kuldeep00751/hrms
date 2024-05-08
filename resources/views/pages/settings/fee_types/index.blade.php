<x-base-layout>
    <div class="col-md-6 mx-auto">

        <div class="card">
            <div class="card">

                <div class="card-header">

                    <div class="pull-left">
                        <a href="/system/settings#finance" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                    </div>

                    <div class="pull-right" role="group">
                        <a href="{{ route('feeTypes.feeType.create') }}" class="btn btn-sm btn-primary" title="Create Fee Type">
                            <i class="fa-solid fa-plus"></i> Add New
                        </a>
                    </div>

                </div>

                @if(count($feeTypes) == 0)
                <div class="card-body text-center">
                    <h4>No Fee Types Available.</h4>
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

                        <table class="table table-row-dashed" id="kt_datatable_example">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Fee Type</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($feeTypes as $feeType)
                                <tr>
                                    <td>{{ $feeType->fee_type_name }}</td>
                                    <td>
                                        <a href="{{ route('feeTypes.feeType.edit', $feeType->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="panel-footer">
                    {!! $feeTypes->render() !!}
                </div>

                @endif

            </div>
        </div>
</x-base-layout>