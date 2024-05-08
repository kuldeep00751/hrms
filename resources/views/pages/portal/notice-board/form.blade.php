<script>

</script>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
            <label for="category" class="control-label">Category <span class="text-danger">*</span></label>

            <select class="form-control" id="category" name="category" required>
                <option value="" style="display: none;" {{ old('category', optional($studentNoticeBoard)->category ?: '') == '' ? 'selected' : '' }} disabled selected>Select category</option>
                @foreach ($categories as $key => $category)
                <option value="{{ $key }}" {{ old('category', optional($studentNoticeBoard)->category) == $key ? 'selected' : '' }}>
                    {{ $category }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            <label for="title" class="control-label">Title <span class="text-danger">*</span></label>

            <input class="form-control" name="title" type="text" id="title" value="{{ old('title', optional($studentNoticeBoard)->title) }}">
            {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('short_description') ? 'has-error' : '' }}">
            <label for="short_description" class="control-label">Short Description <span class="text-danger">*</span></label>

            <textarea class="form-control" name="short_description" id="short_description">{{ old('title', optional($studentNoticeBoard)->title) }}</textarea>
            {!! $errors->first('short_description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('assessment_type_id') ? 'has-error' : '' }}">
            <label for="full_description" class="control-label">Body <span class="text-danger">*</span></label>

            <!-- <textarea class="form-control" id="kt_docs_quill_basic" name="full_description" id="full_description" required>{{ old('full_description', optional($studentNoticeBoard)->full_description) }}</textarea> -->
            <div id="kt_docs_ckeditor_document_toolbar"></div>
            <div id="editor" class="border">{!! old('content', optional($studentNoticeBoard)->full_description) !!}</div>
            <textarea style='display:none;' name='full_description' id='full_description'></textarea>
            {!! $errors->first('full_description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('published') ? 'has-error' : '' }}">
            <label for="published" class="control-label">Publish (Yes/No) <span class="text-danger">*</span></label>
            <select class="form-control" id="published" name="published" required>
                <option value="" style="display: none;" {{ old('published', optional($studentNoticeBoard)->published ?: '') == '' ? 'selected' : '' }} disabled selected>Select published</option>
                @foreach ($publishedYn as $key => $published)
                <option value="{{ $key }}" {{ old('published', optional($studentNoticeBoard)->published) == $key ? 'selected' : '' }}>
                    {{ $published }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('published', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('attachments') ? 'has-error' : '' }}">
            <label for="attachments" class="control-label">Attachments <span class="text-danger">*</span></label>

            <input class="form-control" name="attachments[]" type="file" id="attachments" multiple>
        </div>
    </div>
</div>

@if($studentNoticeBoard)
<div class="row mb-5">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('attachments') ? 'has-error' : '' }}">
            <label for="attachments" class="control-label"><strong>Uploaded Attachments: </strong></label>
            <table class="table">
                @forelse($studentNoticeBoard->attachments as $attachment)
                <tr>
                    <td>{{$attachment->document_name }}</td>
                    <td>
                        <a href="{{ route('notice-boards.notice-board.delete-attachment', $attachment->id) }}" onclick="return confirm('Are you sure you want to delete this attachment?')">
                            <i class="fa-solid fa-trash text-danger"></i>
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
@endif

<script>
    let form = document.getElementById('notice-board-form');

    let editor = document.getElementById('editor');

    let content = document.getElementById('full_description')

    form.addEventListener("submit", function(e) {

        content.value = editor.innerHTML;

    });
</script>