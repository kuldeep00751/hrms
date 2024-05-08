<x-base-layout>
    <div class="col-md-12">

        <div class="card">
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <h6>Device Inventory</h6>
                    </div>

                    <div class="pull-right" role="group">
                        <a href="{{ route('student_device_inventories.student_device_inventory.create') }}" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-plus"></i> Add New
                        </a>
                    </div>
                </div>

                @if(count($studentDeviceInventories) == 0)
                <div class="card-body text-center">
                    <h4>No student devices available.</h4>
                </div>
                @else
                <div class="card-body">
                    @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <h6 class="text-sucstudentLetterscess">
                            <i class="fa-solid fa-circle-check text-success"></i>
                            {!! session('success_message') !!}
                        </h6>
                    </div>
                    @endif
                    <div class="table-responsive">

                        <table class="table table-row-dashed" id="kt_datatable_example">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Device Description</th>
                                    <th>IMEI/Serial Number</th>
                                    <th>Remarks</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($studentDeviceInventories as $studentDeviceInventory)
                                <tr>
                                    <td>{{ $studentDeviceInventory->description }}</td>
                                    <td>{{ $studentDeviceInventory->device_imei }}</td>
                                    <td>{{ $studentDeviceInventory->remarks }}</td>
                                    <td>{{ $studentDeviceInventory->status }}</td>
                                    <td>
                                        <a href="{{ route('student_device_inventories.student_device_inventory.edit', $studentDeviceInventory->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
                                        <a href="{{ route('student_device_inventories.student_device_inventory.show', $studentDeviceInventory->id ) }}" class="btn btn-sm btn-light btn-active-light-info">Show</a>
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