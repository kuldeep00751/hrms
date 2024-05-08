<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('module_id') ? 'has-error' : '' }}">
            <label for="module_id" class="control-label">Module <span class="text-danger">*</span></label>

            <select class="form-control" id="module_id" name="module_id" data-control="select2" required>
                <option value="" style="display: none;" {{ old('module_id', optional($continuousAssessment)->module_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select module</option>
                @foreach ($modules as $key => $module)
                <option value="{{ $key }}" {{ old('module_id', optional($continuousAssessment)->module_id) == $key ? 'selected' : '' }}>
                    {{ $module }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('module_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('academic_year_id') ? 'has-error' : '' }}">
            <label for="academic_year_id" class="control-label">Academic Year <span class="text-danger">*</span></label>

            <select class="form-control" id="academic_year_id" name="academic_year_id" data-control="select2" required>
                <option value="" style="display: none;" {{ old('academic_year_id', optional($continuousAssessment)->academic_year_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select Academic Year</option>
                @foreach ($academicYears as $key => $academicYear)
                <option value="{{ $key }}" {{ old('academic_year_id', optional($continuousAssessment)->academic_year_id) == $key ? 'selected' : '' }}>
                    {{ $academicYear }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('academic_year_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="alert alert-warning text-info">
            The weights should add up 100%.
        </div>
        <table class="table table-row-dashed">
            <thead>
                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                    <th>Mark Type</th>
                    <th>Description</th>
                    <th>Weight (%)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="assessment-weights-table">

            </tbody>
        </table>
        <button class="btn btn-sm btn-primary" type="button" id="addAssessmentButton">
            <i class="fa-solid fa-plus"></i> Add Asssessment Type
        </button>
    </div>
</div>

<script type="text/javascript">
    let addAssessmentButton = document.getElementById('addAssessmentButton');

    addAssessmentButton.addEventListener('click', function() {
        getMarkTypes();
    })

    async function getMarkTypes() {
        const url = "/get-mark-types/";

        const response = await fetch(url, {
                method: "GET",
            })
            .then((response) => response.text())
            .then((data) => {
                let curriculmModules = document.getElementById('assessment-weights-table');

                //curriculmModules.innerHTML = curriculmModules.innerHTML + data;
                $("#assessment-weights-table").append(data)
            })
    }

    document.addEventListener("click", function(e) {
        const target = e.target.closest(".remove-assessment-type"); // Or any other selector.

        if (target) {

            Swal.fire({
                title: "Are you sure you want to remove this Assessment weight?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, I am sure",
            }).then((result) => {
                if (result.isConfirmed) {
                    let td = target.parentNode;
                    let tr = td.parentNode; // the row to be removed
                    tr.parentNode.removeChild(tr);
                }
            });
        }
    });

    // $('body').on('click', '.', function(e) {
    //     e.preventDefault();
    //     //console.log('here')
    //     if (confirm('Are you sure you want to remove this Assessment weight?')) {
    //         let deletedId = $(this).attr('data');

    //         $.ajax({
    //             type: 'POST',
    //             url: '/delete-profile-assistant',
    //             data: {
    //                 _token: $("[name=_token]").val(),
    //                 'id': deletedId
    //             },
    //         });


    //         $(this).closest('table').remove();
    //     }
    // })
</script>