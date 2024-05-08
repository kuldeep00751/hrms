<x-base-layout>
    <div class="card p-5">
        <div id="lecture-timetable"></div>
    </div>

    <div class="modal fade" tabindex="-1" id="module-lectures-modal">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Schedule Module Lectures</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="mb-5 form-group {{ $errors->has('qualification_id') ? 'has-error' : '' }}">

                        <label for="qualification_id" class="control-label">Qualifications <span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <select class="form-control" id="qualification_id" name="qualification_id[]" data-control="select2" multiple="multiple" required>
                                @foreach ($qualifications as $key => $qualification)
                                <option value="{{ $key }}">
                                    {{ $qualification }}
                                </option>
                                @endforeach
                            </select>

                            {!! $errors->first('qualification_id', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('module_id') ? 'has-error' : '' }}">
                                <label for="module_id" class="control-label">Module <span class="text-danger">*</span></label>

                                <select class="form-control" id="module_id" name="module_id" data-control="select2" required>
                                    <option value="" style="display: none;" disabled selected>Select module</option>
                                    @foreach ($modules as $key => $module)
                                    <option value="{{ $key }}">
                                        {{ $module }}
                                    </option>
                                    @endforeach
                                </select>
                                {!! $errors->first('module_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('academic_year_id') ? 'has-error' : '' }}">
                                <label for="academic_year_id" class="control-label">Academic Year <span class="text-danger">*</span></label>

                                <select class="form-control" id="academic_year_id" name="academic_year_id" required>
                                    <option value="" style="display: none;" disabled selected>Select academic year</option>
                                    @foreach ($academicYears as $key => $academicYear)
                                    <option value="{{ $key }}">
                                        {{ $academicYear }}
                                    </option>
                                    @endforeach
                                </select>
                                {!! $errors->first('academic_year_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('academic_intake_id') ? 'has-error' : '' }}">
                                <label for="academic_intake_id" class="control-label">Academic Intake <span class="text-danger">*</span></label>

                                <select class="form-control" id="academic_intake_id" name="academic_intake_id" required>
                                    <option value="" style="display: none;" disabled selected>Select intake</option>
                                    @foreach ($academicIntakes as $key => $academicIntake)
                                    <option value="{{ $key }}">
                                        {{ $academicIntake }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="row mb-5">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('study_mode_id') ? 'has-error' : '' }}">
                                <label for="study_mode_id" class="control-label">Study Mode <span class="text-danger">*</span></label>

                                <select class="form-control" id="study_mode_id" name="study_mode_id" required>
                                    <option value="" style="display: none;" disabled selected>Select study mode</option>
                                    @foreach ($studyModes as $key => $studyMode)
                                    <option value="{{ $key }}">
                                        {{ $studyMode }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('study_mode_id') ? 'has-error' : '' }}">
                                <label for="study_period_id" class="control-label">Study Period <span class="text-danger">*</span></label>

                                <select class="form-control" id="study_period_id" name="study_period_id" required>
                                    <option value="" style="display: none;" disabled selected>Select study period</option>
                                    @foreach ($studyPeriods as $key => $studyPeriod)
                                    <option value="{{ $key }}">
                                        {{ $studyPeriod }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('space_id') ? 'has-error' : '' }}">
                                <label for="space_id" class="control-label">Room <span class="text-danger">*</span></label>

                                <select class="form-control" id="space_id" name="space_id" required>
                                    <option value="" style="display: none;" disabled selected>Select room</option>
                                    @foreach ($spaces as $key => $space)
                                    <option value="{{ $key }}">
                                        {{ $space }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('instructor_id') ? 'has-error' : '' }}">
                                <label for="instructor_id" class="control-label">Instructor <span class="text-danger">*</span></label>

                                <select class="form-control" id="instructor_id" name="instructor_id" required data-control="select2">
                                    <option value="" style="display: none;" disabled selected>Select Instructor</option>
                                    @foreach ($users as $key => $user)
                                    <option value="{{ $key }}">
                                        {{ $user }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</x-base-layout>