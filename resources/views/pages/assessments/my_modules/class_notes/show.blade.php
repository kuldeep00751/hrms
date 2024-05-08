<x-base-layout>
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">

                <div class="pull-left">
                    <a href="{{ route('assessments.my_modules.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> My Modules </a>
                </div>
                <div class="pull-left">
                    <h3>Class Notes</h3>
                </div>
                <div class="pull-right">
                    <a href="#documents-upload" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#documents-upload">
                        <i class="fa-solid fa-plus"></i> Upload New
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
                                    <th>Published</th>
                                    <th>Uploaded By</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($classNotes as $classNote)
                                <tr>
                                    <td>{{ $classNote->description }} </td>
                                    <td>
                                        <!--begin::Switch-->
                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input status-toggle" data-id="{{ $classNote->id }}" type="checkbox" value="{{ $classNote->published }}" {{ ($classNote->published == 1) ? "checked" : ""}} />
                                        </label>
                                        <!--end::Switch-->
                                    </td>
                                    <td>{{ $classNote->uploadedBy->first_name }} {{ $classNote->uploadedBy->last_name }}</td>

                                    <td>

                                        <!--begin::Action menu-->
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen052.svg-->
                                            <i class="bi bi-three-dots fs-3"></i> <!--end::Svg Icon-->
                                        </a>

                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase"><strong>Options</strong></div>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="{{route('my_modules.class_notes.download', $classNote->id )}}" class="menu-link px-3">Download</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="{{route('my_modules.class_notes.delete', $classNote->id )}}" class="menu-link px-3">Delete</a>
                                            </div>
                                        </div>
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

    <div class="modal fade modal-dialog-scrollable" tabindex="-1" id="documents-upload" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Upload class document</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>
                <form method="POST" action="{{ route('my_modules.class_notes.store') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="mb-5 form-group">
                            <label for="document_name" class="col-md-6 control-label required mb-1"><strong>Description / Document Name</strong></label>
                            <div class="col-md-12">
                                <input class="form-control" type="text" name="description" value="">
                                <input class="form-control" type="hidden" id="module_id" name="module_id" value="{{$module->id}}">
                                <input class="form-control" type="hidden" id="uploaded_by" name="uploaded_by" value="{{ auth()->user()->id }}">
                            </div>
                        </div>
                        <div class="mb-5 form-group">
                            <label for="published" class="col-md-6 control-label required mb-1"><strong>Published</strong></label>
                            <div class="col-md-12">
                                <select class="form-control" name="published">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-5 form-group">
                            <label for="document_name" class="col-md-6 control-label required mb-1"><strong>Select Document</strong></label>
                            <div class="col-md-12">
                                <input class="form-control" type="file" name="document" accept="application/pdf" required>
                            </div>
                        </div>
                    </div>

                    <div class=" modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{ csrf_field() }}
    <script>
        let statusToggles = document.querySelectorAll('.status-toggle');

        statusToggles.forEach(function(statusToggle) {
            statusToggle.addEventListener('change', function() {

                let modelId = statusToggle.dataset.id

                let data = {
                    id: statusToggle.dataset.id,
                    published: (statusToggle.checked) ? 1 : 0,
                    '_token': document.getElementsByName("_token")[0].value
                }
                const url = 'published-status'

                const response = fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
            })
        })
    </script>
</x-base-layout>