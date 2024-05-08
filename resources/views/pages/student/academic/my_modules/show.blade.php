<x-base-layout>
    <div class="card">
        <div class="card-header">
            <div class="pull-left">
                <h3>My Modules</h3>
            </div>
        </div>
        <div class="card-body">


            <div class="table-responsive mt-10">
                <!--begin::Table-->
                <table class="table table-row-dashed" id="kt_datatable_example">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bold text-uppercase">
                            <td>Module Name</td>
                            <td>Module Code</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <!--begin::Table row-->
                        @foreach($moduleRegistration as $registration)
                        <tr>
                            <td>{{ $registration->module->module_name }}</td>
                            <td>{{ $registration->module->module_code}}</td>
                            <td>
                                <a href="{{ route('academic.my_modules.class_notes',  $registration->module->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Class Notes</a>
                            </td>

                        </tr>
                        @endforeach
                        <!--end::Table row-->
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
    </div>
</x-base-layout>