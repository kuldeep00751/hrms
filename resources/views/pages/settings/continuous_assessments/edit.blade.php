<x-base-layout>
    <div class="col-md-8 col-sm-12 mx-auto">
        <div class="card">

            <div class="card-header">

                <div class="pull-left">
                    <h4 class="mt-5 mb-5">{{ !empty($continuousAssessment->first()->module->module_name) ? $continuousAssessment->first()->module->module_name." CA Weights" : 'CA Weight' }}</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('continuous_assessments.continuous_assessment.update', $continuousAssessment->first()->module_id.'_'.$continuousAssessment->first()->academic_year_id) }}" accept-charset="UTF-8" class="form-horizontal">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PUT">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('module_id') ? 'has-error' : '' }}">
                                <label for="module_id" class="control-label">Module <span class="text-danger">*</span></label>

                                <select class="form-control" id="module_id" name="module_id" data-control="select2" readonly>
                                    @foreach ($modules as $key => $module)
                                    <option value="{{ $key }}" {{ old('module_id', optional($continuousAssessment)->first()->module_id) == $key ? 'selected' : '' }}>
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

                                <select class="form-control" id="academic_year_id" name="academic_year_id" readonly>
                                    @foreach ($academicYears as $key => $academicYear)
                                    <option value="{{ $key }}" {{ old('academic_year_id', optional($continuousAssessment)->first()->academic_year_id) == $key ? 'selected' : '' }}>
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
                                    @foreach($continuousAssessment as $weight)

                                    <tr>
                                        <td>
                                            <select name="mark_type_id[]" aria-label="{{ __('MarkType') }}" data-placeholder="{{ __('Select mark type...') }}" class="form-select form-select-solid fw-bold" required>
                                                <option value="" style="display: none;" disabled selected>Select Mark Type</option>
                                                @foreach ($markTypes as $key => $markType)
                                                <option value="{{ $key }}" {{ old('mark_type_id', optional($weight)->mark_type_id) == $key ? 'selected' : '' }}>
                                                    {{ $markType }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="continuous_assessment_weight_id[]" value="{{$weight->id}}">
                                        </td>
                                        <td>
                                            <input class="form-control" name="assessment_description[]" value="{{$weight->assessment_description}}" type="text" placeholder="Ex. Assignment 1, Test 1">
                                        </td>
                                        <td>
                                            <input class="form-control" name="weight[]" type="number" value="{{$weight->weight}}" minlength="1" maxlength="255" placeholder="0.0">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-light-danger remove-assessment-type" data-id="{{ $weight->id }}"> <i class="fa-solid fa-times"></i> </button>
                                        </td>
                                    </tr>
                                    @endforeach
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
                            const continuousAssessmentId = e.target.dataset.id;

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
                                        //tr.parentNode.removeChild(tr);

                                        //check if the paper has paper marks captured
                                        const url = `/continuous_assessments/mark_type/${continuousAssessmentId}/delete`;

                                        const response = fetch(url, {
                                                method: "GET",
                                            })
                                            .then((response) => response.json())
                                            .then((data) => {
                                                
                                                if (data.status) {
                                                    let td = target.parentNode;
                                                    let tr = td.parentNode; // the row to be removed
                                                    tr.parentNode.removeChild(tr);
                                                } else {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        text: `${data.message}`,
                                                    })
                                                }

                                            })
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

                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Update">
                        <a href="{{ route('continuous_assessments.continuous_assessment.index') }}" title="Show All Weights">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>