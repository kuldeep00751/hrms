<x-base-layout>
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <h3>Student Blocks</h3>
                </div>
                <div class="pull-right">
                    <a href="{{ route('student_blocks.student_block.create') }}" class="btn btn-sm btn-light btn-active-light-primary">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                    <a href="{{ route('student_blocks.student_block.bulk-remove') }}" data-bs-toggle="modal" data-bs-target="#bulk-remove" class="btn btn-sm btn-light btn-active-light-danger">
                        <i class="fa-solid fa-trash"></i> Bulk Remove
                    </a>
                    <a href="{{ route('student_blocks.advanced_options.index') }}" class="btn btn-sm btn-light btn-active-light-info">
                        <i class="fa-solid fa-cog"></i> Advanced Options
                    </a>
                </div>
            </div>

            @if(count($studentBlocks) == 0)
            <div class="card-body text-center">
                <h6>No Student Blocks Available.</h6>
            </div>
            @else
            <div class="card-body">
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
                <div class="table-responsive">

                    <table class="table table-row-dashed" id="kt_datatable_example">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                <th>Student Number</th>
                                <th>Student Name</th>
                                <th>Reason</th>
                                <th>Blocked By</th>
                                <th>Batch Number</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studentBlocks as $studentBlock)
                            <tr>
                                <td>{{ $studentBlock->userInfo->student_number }}</td>
                                <td>{{ $studentBlock->userInfo->first_names }} {{ $studentBlock->userInfo->surname }}</td>
                                <td>{{ $studentBlock->reason }}</td>
                                <td>{{ $studentBlock->blockedBy->first_name }} {{ $studentBlock->blockedBy->last_name }}</td>
                                <td>{{ $studentBlock->batch_number }}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="panel-footer">
                {!! $studentBlocks->render() !!}
            </div>

            @endif
        </div>
    </div>



    <div class="modal fade modal-dialog-scrollable" tabindex="-1" id="bulk-remove" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Bulk Block Removals</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>
                <form method="POST" action="{{ route('student_blocks.student_block.bulk-remove') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <label for="batch_number" class="col-md-6 control-label mb-1"><strong>Unblock Option: </strong></label>
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="radio" value="student_number" name="unblock_option" required />
                            <label class="form-check-label" for="flexRadioDefault">
                                Student Numbers
                            </label>
                        </div>

                        <label class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="radio" value="batch_number" name="unblock_option" required />
                            <span class="form-check-label">
                                Bath number
                            </span>
                        </label>


                        <div class="mb-5 form-group {{ $errors->has('student_number') ? 'has-error' : '' }}">
                            <label for="student_number" class="control-label"><strong>Student Number <span class="text-danger">*</span></strong></label>
                            <div class="col-md-12">
                                <textarea class="form-control" name="student_numbers" placeholder="Example; 202381892, 2022987182">{{ old('student_numbers') }}</textarea>
                            </div>
                        </div>

                        <div class="mb-5 form-group">
                            <label for="batch_number" class="col-md-6 control-label mb-1"><strong>Batch Number</strong></label>
                            <div class="col-md-12">
                                <input class="form-control" name="batch_number" type="text" id="batch_number" value="{{ old('batch_number') }}">
                            </div>
                        </div>
                    </div>

                    <div class=" modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Remove</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-base-layout>