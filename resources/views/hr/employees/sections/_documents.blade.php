<!--begin::Basic info-->
<div class="card {{ $class }}">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('Upload Documents') }}</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="documents" class="collapse show">
        <!--begin::Card body-->
        <div class="card-body border-top p-9">
            <div class="alert alert-info">
                <p>Please upload all required documents</p>
                <ul>
                    <li>Maximum file size is 4MB per file</li>
                    <li>We only allow PDF documents</li>
                    <li>Documents marked with <span class="fas fa-check-circle text-success"></span> have already been uploaded. Please do not re-upload again unless you wish to update the uploaded document</li>
                    <li>Documents marked with <span class="fas fa-times-circle text-danger"></span> have not yet been uploaded.</li>
                </ul>
            </div>
            @foreach ($employeerequiredDocuments as $employeerequiredDocument)
            <div class="row mb-3">
                @php
                $uploaded = $employeeDocuments->where('employee_required_document_id', $employeerequiredDocument->id)->first();

                $is_required = true;

                if(!$employeerequiredDocument->is_required){
                $is_required = false;
                }

                if($uploaded){
                $is_required = false;
                }

                @endphp
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6 {{ ($is_required) ? 'required':'' }}">{{ $employeerequiredDocument->document_name }}
                    @if($uploaded)
                    <span class="fas fa-check-circle text-success"></span>
                    @else
                    <span class="fas fa-times-circle text-danger"></span>
                    @endif
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="file" name="document[{{$employeerequiredDocument->id}}]" class="form-control form-control-lg form-control-solid" {{ ($is_required) ? 'required':'' }} data-label="{{ $employeerequiredDocument->document_name }}" accept="application/pdf"/>
                </div>
                <!--end::Col-->

            </div>
            @endforeach

        </div>
        <!--end::Card body-->
    </div>
    <!--end::Content-->
</div>
<!--end::Basic info-->