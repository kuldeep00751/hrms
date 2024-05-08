<x-base-layout>
    <div class="col-md-6 col-sm-12 mx-auto">
        <div class="card">

            <div class="card-header">
                <div class="pull-left">
                    <a href="/payment_descriptions" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Payment Descriptions</a>
                </div>
                <div class="pull-right">
                    <h4 class="mt-5 mb-5">{{ !empty($paymentDescription->charge_type) ? $paymentDescription->payment_description : 'Payment Description' }}</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('payment_descriptions.payment_description.update', $paymentDescription->id) }}" accept-charset="UTF-8" class="form-horizontal">
                <div class="card-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif


                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PUT">
                    @include ('pages.settings.payment_descriptions.form', [
                    'paymentDescription' => $paymentDescription,
                    ])

                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Update">
                        <a href="{{ route('payment_descriptions.payment_description.index') }}">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>