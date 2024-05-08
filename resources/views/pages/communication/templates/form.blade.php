<div class="mb-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="control-label">Template Name <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($documentTemplate)->name) }}" placeholder="Enter template name here..." required>
    </div>
</div>


<div class="form-group {{ $errors->has('end') ? 'has-error' : '' }}">
    <label for="template" class="control-label">Upload Template <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="template" type="file" accept="application/pdf" required>
    </div>
</div>