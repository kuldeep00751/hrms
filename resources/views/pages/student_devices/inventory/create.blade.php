<x-base-layout>
    <div class="col-md-6 mx-auto">

        <div class="card">
            <div class="card-header">

                <span class="pull-left">
                    <h4 class="mt-5 mb-5">Add New Device</h4>
                </span>

            </div>

            <div class="card-body">

                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <form method="POST" action="{{ route('student_device_inventories.student_device_inventory.store') }}" accept-charset="UTF-8" class="form-horizontal">
                    {{ csrf_field() }}
                    @include ('pages.student_devices.inventory.form', [
                    'studentDeviceInventory' => null,
                    ])
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <input class="btn btn-success" type="submit" value="Save">
                    <a href="{{ route('student_device_inventories.student_device_inventory.index') }}"  title="Show All Year Level">
                        Cancel
                    </a>
                </div>
            </div>
            </form>
        </div>
    </div>
</x-base-layout>