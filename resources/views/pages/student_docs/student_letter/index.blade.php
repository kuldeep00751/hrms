<x-base-layout>
    <div class="row">
        <div class="col-md-12 mb-5">

            <div class="bg-white p-5">
                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <form method="POST" action="{{ route('student_docs.student_letters.download') }}" accept-charset="UTF-8" class="form-horizontal">
                    @csrf
                    <table class="table">
                        <tr>
                            <td>
                                <!--begin::Label-->
                                <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Student number:') }}</label>
                                <!--end::Label-->
                                <div class="form-group {{ $errors->has('student_number') ? 'has-error' : '' }}">
                                    <div class="col-md-12">
                                        <input class="form-control" name="student_number" type="number" id="student_number" value="{{ old('student_number', $filterData['student_number'] ?? '') }}" placeholder="Enter student number here..." required>
                                    </div>
                                </div>

                            </td>
                            <td>
                                <!--begin::Label-->
                                <label class="col-form-label text-gray-400 fw-bold text-uppercase">{{ __('Letter:') }}</label>
                                <!--end::Label-->
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <select name="student_letter_id" aria-label="{{ __('Student Letter') }}" data-placeholder="{{ __('Select student letter...') }}" data-control="select2" class="form-select form-select-solid fw-bold" required>
                                            <option value="" style="display: none;" disabled selected>Select student letter...</option>
                                            @foreach ($studentLetters as $key => $studentLetter)
                                            <option value="{{ $key }}">
                                                {{ $studentLetter }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td style="text-align: center; vertical-align: bottom;">
                                <!--begin::Label-->
                                <label class="col-form-label text-gray-400 fw-bold text-uppercase"></label>
                                <!--end::Label-->
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary col-md-12">
                                            <span class="fas fa-download"></span> Download Letter
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>

                </form>

            </div>
        </div>
    </div>
</x-base-layout>