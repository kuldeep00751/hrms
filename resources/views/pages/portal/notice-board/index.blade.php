<x-base-layout>
    <div class="col-md-12">

        <div class="card">
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <h6>List of notices</h6>
                    </div>

                    <div class="pull-right" role="group">
                        <a href="{{ route('notice-boards.notice-board.create') }}" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-plus"></i> Add New
                        </a>
                    </div>
                </div>

                @if(count($studentNoticeBoards) == 0)
                <div class="card-body text-center">
                    <h4>No notices Available.</h4>
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
                    <div class="table-responsive">

                        <table class="table" id="kt_datatable_example" style="font-size: 12px; cursor: pointer;">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Notice</th>
                                    <th>Category</th>
                                    <th>Posted</th>
                                    <th>Published</th>
                                    <th>Posted By</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($studentNoticeBoards as $studentNoticeBoard)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{ $studentNoticeBoard->title }}</a>

                                                <span class="text-muted fw-bold text-muted d-block fs-7">
                                                    {{ $studentNoticeBoard->short_description }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="{{ $studentNoticeBoard->getCategoryClassNames($studentNoticeBoard->category) }}">{{ $studentNoticeBoard->category }}</span>
                                    </td>
                                    <td>{{ date('d, M Y', strtotime($studentNoticeBoard->created_at)) }}</td>
                                    <td>{{ ($studentNoticeBoard->published) ? 'Yes' : 'No' }}</td>
                                    <td>{{ $studentNoticeBoard->postedBy->first_name }} {{ $studentNoticeBoard->postedBy->last_name }}</td>

                                    <td>
                                        <a href="{{ route('notice-boards.notice-board.show', $studentNoticeBoard->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Preview</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('notice-boards.notice-board.edit', $studentNoticeBoard->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</x-base-layout>