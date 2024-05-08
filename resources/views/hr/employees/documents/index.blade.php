<x-base-layout>
    <div class="col-md-8 mx-auto">

        <div class="card">

            <div class="card-header">
                <h4 class="mt-5 mb-5">My Documents</h4>
            </div>

            <div class="card-body">
                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
                @if(Session::has('success_message'))
                <div class="alert alert-success">
                    <h6 class="text-success">
                        <i class="fa-solid fa-circle-check text-success"></i>
                        {!! session('success_message') !!}
                    </h6>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-row-dashed">
                        <thead>
                            <tr class="text-start text-gray-800 fw-bold text-uppercase">
                                <th>Document</th>
                                <th class="text-center">Required (Yes/No)</th>
                                <th class="text-center">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employeerequiredDocuments as $requiredDocument)

                            <tr>
                                <td>{{ $requiredDocument->document_name }}</td>
                                <td class="text-center">{{ ($requiredDocument->is_required) ? "Yes" : "No"}}</td>
                                <td class="text-center">
                                    @if($employeeDocuments->contains('employee_required_document_id',$requiredDocument->id))
                                    <i class="fa-solid fa-circle-check text-success"></i>
                                    @else
                                    <i class="fa-solid fa-circle-xmark text-danger"></i>
                                    @endif
                                </td>
                                <td>
                                    <input type="hidden" value="{{ $requiredDocument->document_name }}" id="document_{{ $requiredDocument->id }}">

                                    <a href="#documents-upload" data-id="{{ $requiredDocument->id }}" class="btn btn-sm btn-light btn-active-light-primary upload-btn" data-bs-toggle="modal" data-bs-target="#documents-upload"><i class="fa-solid fa-upload"></i> Upload</a>
                                   
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-dialog-scrollable" tabindex="-1" id="documents-upload" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Upload document</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>
                <form method="POST" action="{{ route('employee_documents.employee_document.store') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="mb-5 form-group">
                            <label for="document_name" class="col-md-6 control-label required mb-1"><strong>Document Name</strong></label>
                            <div class="col-md-12">
                                <input class="form-control" type="text" id="document_name" value="" readonly>
                                <input class="form-control" type="hidden" id="employee_required_document_id" name="employee_required_document_id" value="">
                                <input class="form-control" type="hidden" id="employee_id" name="employee_id" value="{{ $info->id }}">
                            </div>
                        </div>
                        <div class="mb-5 form-group">
                            <label for="document_name" class="col-md-6 control-label required mb-1"><strong>Upload Document</strong></label>
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

    <script>
        let uploadButtons = document.querySelectorAll('.upload-btn');

        uploadButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {

                let documentId = button.dataset.id;

                let getDocumentName = document.getElementById(`document_${documentId}`);

                let setDocumentName = document.getElementById('document_name');

                setDocumentName.value = getDocumentName.value;

                let setDocumentId = document.getElementById('employee_required_document_id');

                setDocumentId.value = documentId;

            })
        });
    </script>
</x-base-layout>