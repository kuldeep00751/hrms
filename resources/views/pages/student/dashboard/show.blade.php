<x-base-layout>


    <div class="col-md-8 col-sm-12 mx-auto">
        <h4 class="text-muted">
            Hi, {{ auth()->user()->first_name}} {{ auth()->user()->last_name}}
        </h4>
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <a href="/student/dashboard" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Dashboard</a>
                </div>
                <h4>{{ $studentNoticeBoard->title }}
                    <small>
                        <span class="{{ $studentNoticeBoard->getCategoryClassNames($studentNoticeBoard->category) }}">{{ $studentNoticeBoard->category }}</span>
                    </small>
                </h4>
            </div>
            <div class="card-body">
                {!! $studentNoticeBoard->full_description !!}

                <div class="row mb-5">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group {{ $errors->has('attachments') ? 'has-error' : '' }}">
                            <label for="attachments" class="control-label"><strong>Attachments: </strong></label>
                            <table class="table table-row-dashed table-hover">
                                @forelse($studentNoticeBoard->attachments as $attachment)
                                <tr>
                                    <td>{{$attachment->document_name }}</td>
                                    <td>
                                        <a href="{{ route('notice-boards.notice-board.download', $attachment->id) }}">
                                            <i class="fa-solid fa-download text-primary"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-warning text-black">
                                    There are no attachments for this notice.
                                </div>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base-layout>