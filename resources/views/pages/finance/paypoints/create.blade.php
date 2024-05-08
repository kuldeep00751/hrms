<x-base-layout>
    <div class="row col-sm-12 col-md-7 mx-auto">
        <div class="col-md-9">

            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <a href="/finance/payments" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Paypoints</a>
                    </div>
                    <div class="card-title">
                        <h5>Create Paypoint</h5>
                    </div>
                </div>
                <form method="POST" action="{{ route('finance.paypoints.store') }}" accept-charset="UTF-8" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="card-body">
                        @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            <i class="fa-solid fa-circle-xmark text-danger"></i>
                            {{ $error }}
                            @endforeach
                        </ul>
                        @endif
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                                    <label for="user_id" class="control-label">Cashier <span class="text-danger">*</span></label>

                                    <select class="form-control" id="user_id" name="user_id" required>
                                        <option value="" style="display: none;" {{ old('user_id') ? 'selected' : '' }} disabled selected>Select cashier</option>
                                        @foreach ($users as $key => $user)
                                        <option value="{{ $key }}" {{ old('user_id') == $key ? 'selected' : '' }}>
                                            {{ $user }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row mb-5">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('campus_id') ? 'has-error' : '' }}">
                                    <label for="campus_id" class="control-label">Paypoint <span class="text-danger">*</span></label>

                                    <select class="form-control" id="campus_id" name="campus_id" required>
                                        <option value="" style="display: none;" {{ old('campus_id') ? 'selected' : '' }} disabled selected>Select pay point</option>
                                        @foreach ($campuses as $key => $campus)
                                        <option value="{{ $key }}" {{ old('campus_id') == $key ? 'selected' : '' }}>
                                            {{ $campus }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-flex justify-content-end py-6 px-9 bg-white">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</x-base-layout>