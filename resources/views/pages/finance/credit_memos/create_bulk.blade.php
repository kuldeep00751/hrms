<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">

            <div class="card-header">
                <div class="pull-left">
                    <a href="{{ route('finance.student_charges.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Student Charges</a>
                </div>
                <span class="pull-right">
                    <h4 class="mt-5 mb-5">Add New Credit Memos</h4>
                </span>
            </div>
            <form method="POST" action="{{ route('finance.credit_memos.storeBulk') }}" accept-charset="UTF-8" class="form-horizontal">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif


                    {{ csrf_field() }}
                    @include ('pages.finance.credit_memos.form', [
                    'creditMemo' => null,
                    'bulk' => true,
                    ])

                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">

                        <a href="{{ route('finance.credit_memos.index') }}">
                            Cancel
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-base-layout>