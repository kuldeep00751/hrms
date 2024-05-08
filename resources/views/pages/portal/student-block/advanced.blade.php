<x-base-layout>
    <div class="col-md-10 mx-auto">
        <form method="POST" action="{{ route('student_blocks.advanced_options.store') }}" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <a href="{{ route('student_blocks.student_block.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Student Blocks</a>
                    </div>
                </div>
                <div class="card-body">
                    <h4>Financial Blocks</h4>
                    <div class="separator separator-dashed mx-5 my-5"></div>

                    @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <h6 class="text-success">
                            <i class="fa-solid fa-circle-check text-success"></i>
                            {!! session('success_message') !!}
                        </h6>
                    </div>
                    @endif
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <div class="row mb-5">
                        <label class="mb-3"><strong>Do you want to block students who owe?</strong></label>
                        <div class="col-md-12">
                            @php
                            $financialBlock = $advancedBlocks->where('block_type', 'FinancialBlock')->first();
                            @endphp
                            <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                                <!--begin::Switch-->
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    No
                                    <input class="form-check-input" name="FinancialBlock" type="checkbox" value="1" @if(isset($financialBlock)) checked @endif />
                                    Yes
                                </label>
                                <!--end::Switch-->
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                                <label for="amount" class="control-label"><strong>If yes, what is the minimum amount you wish to block? <span class="text-danger">*</span></strong></label>
                                <div class="input-group mb-5">
                                    <span class="input-group-text">N$</span>
                                    <input class="form-control" name="minimum_amount" type="number" id="minimum_amount" value="{{optional($financialBlock)->value }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card mt-5">
                <div class="card-body">
                    <h4>Qualification Blocks</h4>
                    <div class="separator separator-dashed mx-5 my-5"></div>

                    <div class="row mb-5">
                        <label class="mb-3"><strong>Do you want to block students who are studying specific qualifications?</strong></label>
                        <div class="col-md-12">
                            @php
                            $qualificationBlocks = $advancedBlocks->where('block_type', 'QualificationBlock')->first();

                            @endphp
                            <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                                <!--begin::Switch-->
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    No
                                    <input class="form-check-input" name="QualificationBlock" type="checkbox" value="1" {{ ($qualificationBlocks) ? 'checked': '' }} />
                                    Yes
                                </label>
                                <!--end::Switch-->
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('module_id') ? 'has-error' : '' }}">
                                <label for="module_id" class="control-label"><strong>If yes, select the qualifications you wish to block <span class="text-danger">*</span></strong></label>

                                <select class="form-control" id="qualifications" name="qualifications[]" data-control="select2" multiple>
                                    @foreach ($qualifications as $key => $qualification)
                                    @if($qualificationBlocks)
                                    <option value="{{ $key }}" {{ (in_array($key, json_decode($qualificationBlocks->value))) ? 'selected' : ''}}>
                                        @else
                                        <option value="{{ $key }}" >
                                        @endif
                                        {{ $qualification }}
                                    </option>
                                    @endforeach
                                </select>
                                {!! $errors->first('qualification_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">

                        <a href="{{ route('student_blocks.student_block.index') }}">
                            Cancel
                        </a>
                    </div>

                </div>

            </div>
        </form>
    </div>

</x-base-layout>