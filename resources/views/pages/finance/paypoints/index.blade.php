<x-base-layout>
    <div class="col-md-7 mx-auto">
        <div class="card">
            <div class="card-header">

                <div class="pull-left">
                    <h3>Cashier Paypoints</h3>
                </div>

                <div class="pull-right" role="group">
                    <a href="{{ route('finance.paypoints.create') }}" class="btn btn-sm btn-primary" title="Create New Subject Fee">
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

                @if(!count($cashierPaypoints))
                <div class="alert alert-danger">
                    No cashier has been mapped to a pay point
                </div>
                @else
                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">

                        <table class="table table-row-dashed" id="kt_datatable_example">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Cashier Name</th>
                                    <th>Paypoint</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cashierPaypoints as $paypoint)
                                <tr>
                                    <td>{{ $paypoint->user->first_name }} {{ $paypoint->user->last_name }}</td>
                                    <td>{{ $paypoint->campus->name }} </td>

                                    <td>
                                        <form method="POST" action="{{ route('finance.paypoints.destroy', $paypoint->id) }}" accept-charset="UTF-8" class="form-horizontal">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="delete">
                                            <button type="submit" class="btn btn-sm btn-light btn-active-light-danger">Delete</button>
                                        </form>
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