<div class="alert alert-info">
    You can provide more than one student number separated by a comma. Example; 202381892, 2022987182.
</div>
<div class="mb-5 form-group {{ $errors->has('student_number') ? 'has-error' : '' }}">
    <label for="student_number" class="control-label">Student Number <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <textarea class="form-control" name="student_number" placeholder="Example; 202381892, 2022987182" required>{{ old('student_number', optional($studentBlockException)->student_number) }}</textarea>
    </div>
</div>
<div class="mb-5 form-group {{ $errors->has('reason') ? 'has-error' : '' }}">
    <label for="reason" class="control-label">Reason <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <textarea class="form-control" name="reason" placeholder="Enter reason here..." required>{{ old('reason', optional($studentBlockException)->reason) }}</textarea>
    </div>
</div>