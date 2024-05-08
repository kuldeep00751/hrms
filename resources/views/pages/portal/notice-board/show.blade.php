<x-base-layout>
    <div class="col-md-12">

        <div class="card">
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <a href="{{ route('notice-boards.notice-board.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Notices</a>
                    </div>
                    <div class="pull-right">
                        <h6>Notice Preview</h6>
                    </div>
                </div>

                <div class="card-body">

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                                <label for="category" class="control-label"><strong>Category: </strong></label>

                                <span class="{{ $studentNoticeBoard->getCategoryClassNames($studentNoticeBoard->category) }}">{{ $studentNoticeBoard->category }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label for="title" class="control-label"><strong>Title: </strong></label>
                                {{ $studentNoticeBoard->title }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('short_description') ? 'has-error' : '' }}">
                                <label for="short_description" class="control-label"><strong>Short Description: </strong></label>
                                <p>{{ old('title', optional($studentNoticeBoard)->short_description) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('assessment_type_id') ? 'has-error' : '' }}">
                                <label for="full_description" class="control-label"><strong>Body </strong></label>
                                {!! $studentNoticeBoard->full_description !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('published') ? 'has-error' : '' }}">
                                <label for="published" class="control-label"><strong>Published: </strong></label>
                                {{ $studentNoticeBoard->published ? 'Yes' : 'No' }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('attachments') ? 'has-error' : '' }}">
                                <label for="attachments" class="control-label"><strong>Attachments: </strong></label>
                                <table class="table">
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
    </div>
</x-base-layout>