<x-base-layout>
    <div class="col-md-8 mx-auto">
        <div class="card">

            <div class="card-header">
                <div class="pull-left">
                    <a href="{{ route('leave-mananagements.leave-mananagement.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Leaves</a>
                </div>
                <span class="pull-right">
                    <h4 class="mt-5 mb-5">Leave Application</h4>
                </span>
            </div> 
            <form method="POST" action="{{ route('leave-mananagements.leave-mananagement.update', $leaveManage->id) }}" accept-charset="UTF-8" class="form-horizontal" id="notice-board-form" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                
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

                    {{ csrf_field() }}
                    @include ('hr.leave-management.form', [
                    'leaveManage' => $leaveManage,
                    ]) 

                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">

                        <a href="{{ route('leave-mananagements.leave-mananagement.index') }}">
                            Cancel
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-base-layout>