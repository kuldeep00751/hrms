<div class="mb-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="control-label"><strong>Letter Name <span class="text-danger">*</span></strong></label>
    <div class="col-md-12">
        <input class="form-control" name="letter_name" type="text" id="letter_name" value="{{ old('letter_name', optional($studentLetter)->letter_name) }}" placeholder="Enter letter name here..." required>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('qualification_id') ? 'has-error' : '' }}">
            <label for="qualification_id" class="control-label required"><strong>Qualifications</strong></label>
            <select class="form-control" id="qualification_id" name="qualification_id[]" data-control="select2" multiple="" required>
                @foreach ($qualifications as $key => $qualification)
                <option value="{{ $key }}" {{ (in_array($key, old('qualification_id', $studentLetter->qualification_id ?? []))) ? 'selected' : '' }}>
                    {{ $qualification }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>


<div class="row mb-5">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('academic_intake_id') ? 'has-error' : '' }}">
            <label for="academic_intake_id" class="control-label required"><strong>Academic Intake</strong></label>
            <select class="form-control" id="academic_intake_id" name="academic_intake_id[]" data-control="select2" multiple="" required>
                @foreach ($academicIntakes as $key => $academicIntake)
                <option value="{{ $key }}" {{ (in_array($key, old('academic_intake_id', $studentLetter->academic_intake_id ?? []))) ? 'selected' : '' }}>
                    {{ $academicIntake }}
                </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('academic_year_id') ? 'has-error' : '' }}">
            <label for="academic_year_id" class="control-label required"><strong>Academic Year</strong></label>
            <select class="form-control" id="academic_year_id" name="academic_year_id" required>
                <option value="" style="display: none;" {{ old('academic_year_id', optional($studentLetter)->academic_year_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select academic year</option>
                @foreach ($academicYears as $key => $academicYear)
                <option value="{{ $key }}" {{ old('academic_year_id', optional($studentLetter)->academic_year_id) == $key ? 'selected' : '' }}>
                    {{ $academicYear }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('campus_id') ? 'has-error' : '' }}">
            <label for="campus_id" class="control-label required"><strong>Campuses</strong></label>
            <select class="form-control" id="campus_id" name="campus_id[]" data-control="select2" multiple="" required>
                @foreach ($campuses as $key => $campus)
                <option value="{{ $key }}" {{ (in_array($key, old('campus_id', $studentLetter->campus_id ?? []))) ? 'selected' : '' }}>
                    {{ $campus }}
                </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('admission_status_id') ? 'has-error' : '' }}">
            <label for="admission_status_id" class="control-label required"><strong>Admission Status</strong></label>
            <select class="form-control" id="admission_status_id" name="admission_status_id[]" data-control="select2" multiple="" required>
                <option value="pending" {{ (in_array('pending', old('admission_status_id', $studentLetter->admission_status_id ?? []))) ? 'selected' : '' }}>
                    Pending
                </option>
                @foreach ($admissionStatuses as $key => $admissionStatus)
                <option value="{{ $admissionStatus }}" {{ (in_array($admissionStatus, old('admission_status_id', $studentLetter->admission_status_id ?? []))) ? 'selected' : '' }}>
                    {{ $admissionStatus }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
        <label for="content" class="control-label required strong"><strong>Content</strong></label>
        <div class="alert alert-info">
            <p>Use the parameters below in your template. Remember to enclose all parameteres in curly brackets without space. Best practice is to copy and paste each parameter, instead of retyping it.</p>
            <p> Example: <br>
                <strong>
                    {StudentNumber}, {Title}, {StudentFirstName}, {StudentSurname}, {StudentAddressLine1}, {StudentAddressLine2}, {StudentAddressLine3}, {StudentEmail}, {IDNumber}<br>
                    {Date},{StudentPostalAddress1}, {StudentPostalAddress2}, {StudentPostalAddress3}<br>
                    {QualificationName},{QualificationCode}, {CampusName}, {AcademicIntake}, {AcademicYear}, {AdmissionStatus}
                </strong>
            </p>
        </div>
        <div id="kt_docs_ckeditor_document_toolbar"></div>
        <div id="editor" class="border">{!! old('content', optional($studentLetter)->content) !!}</div>
        <textarea style='display:none;' name='content' id='content'></textarea>
    </div>
</div>

<script>
    let form = document.getElementById('letter-form');

    let editor = document.getElementById('editor');

    let content = document.getElementById('content')

    form.addEventListener("submit", function(e) {

        content.value = editor.innerHTML;

    });
</script>