<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">

            <div class="card-header">
                <div class="pull-left">
                    <a href="{{ route('student_block_exceptions.student_block_exception.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Student Block Exceptions</a>
                </div>
                <span class="pull-right">
                    <h4>Add New Student Block Exception</h4>
                </span>

            </div>
            <form method="POST" action="{{ route('student_block_exceptions.student_block_exception.store') }}" accept-charset="UTF-8" class="form-horizontal">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif


                    {{ csrf_field() }}
                    @include ('pages.portal.student_block_exceptions.form', [
                    'studentBlockException' => null,
                    ])
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">
                        <a href="{{ route('student_blocks.student_block.index') }}">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>