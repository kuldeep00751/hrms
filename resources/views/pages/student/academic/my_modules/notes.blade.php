<x-base-layout>
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">

                <div class="pull-left">
                    <a href="{{ route('academic.my_modules') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> My Modules </a>
                </div>
                <div class="pull-left">
                    <h3>Class Notes</h3>
                </div>

            </div>
            <div class="card-body">

                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">
                        <table style="width: 50%">
                            <tr>
                                <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Module Name</strong></th>
                                <td>{{ $module->module_name }}</td>
                            </tr>
                            <tr>
                                <th class="text-start text-gray-400 fw-bold text-uppercase"><strong>Module Code</strong></th>
                                <td>{{ $module->module_code }}</td>
                            </tr>

                        </table>
                        <hr>

                        <table class="table table-row-dashed" id="kt_datatable_example">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Description</th>
                                    <th>Uploaded</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($classNotes as $classNote)
                                <tr>
                                    <td>{{ $classNote->description }} </td>
                                  
                                    <td>{{ $classNote->created_at }}</td>

                                    <td>
                                        <a href="{{ route('my_modules.class_notes.download',  $classNote->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Download</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="alert alert-info">
                                            No class notes have been uploaded
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base-layout>