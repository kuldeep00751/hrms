<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">

            <div class="card-header">

                <div class="pull-left">
                    <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Module' }}</h4>
                </div>

            </div>

            <div class="card-body">

                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <form method="POST" action="{{ route('modules.module.update', $module->id) }}" id="edit_module_form" name="edit_module_form" accept-charset="UTF-8" class="form-horizontal">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PUT">
                    @include ('pages.settings.modules.form', [
                    'module' => $module,
                    ])

                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Update">
                        <a href="{{ route('modules.module.index') }}"  title="Show All Module">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>

</x-base-layout>