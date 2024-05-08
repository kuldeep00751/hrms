<x-base-layout>
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">

                <div class="pull-left">
                    <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Curriculum' }}</h4>
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
                <table class="table table-rounded table-striped border">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bold text-uppercase">
                            <th>Qualification Name</th>
                            <th>Qualification Code</th>
                            <th>Qualification Level</th>
                            <th>No. of years</th>
                            <th>NQF level</th>
                            <th>Credits</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $qualification->qualification_name }}</td>
                            <td>{{ $qualification->qualification_code }}</td>
                            <td>{{ optional($qualification->qualificationType)->application_type }}</td>
                            <td>{{ optional($qualification->numberOfYears)->year_level }}</td>
                            <td>{{ optional($qualification->nqfLevel)->nqf_level }}</td>
                            <td>{{ $qualification->qualification_credits }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-5 mb-5">
        <div class="card">
            <div class="card-header">
                <h6>Qualification Modules</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('academic_structures.academic_structure.update', $qualification->id) }}" id="edit_curriculm_form" name="edit_curriculm_form" accept-charset="UTF-8" class="form-horizontal">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PUT">
                    @include ('pages.settings.academic_structures.form', [
                    'qualification' => $qualification,
                    ])

                    <div class="form-group mt-10">
                        <input class="btn btn-success" type="submit" value="Update">
                        <a href="{{ route('modules.module.index') }}" title="Show All Module">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-base-layout>