<x-base-layout>
    <div class="col-md-8 mx-auto">
        <div class="card">

            <div class="card-header">
                <div class="pull-left">
                    <a href="{{ route('notice-boards.notice-board.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Notices</a>
                </div>
                <span class="pull-right">
                    <h4 class="mt-5 mb-5">Create New Notice Board Item</h4>
                </span>
            </div>
            <form method="POST" action="{{ route('notice-boards.notice-board.store') }}" accept-charset="UTF-8" class="form-horizontal" id="notice-board-form" enctype="multipart/form-data">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif


                    {{ csrf_field() }}
                    @include ('pages.portal.notice-board.form', [
                    'studentNoticeBoard' => null,
                    ])

                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">

                        <a href="{{ route('notice-boards.notice-board.index') }}">
                            Cancel
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-base-layout>