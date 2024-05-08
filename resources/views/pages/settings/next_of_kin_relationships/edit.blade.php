<x-base-layout>
    <div class="col-md-6 mx-auto">

        <div class="card">

            <div class="card-header">
                <div class="pull-left">
                    <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Next Of Kin Relationship' }}</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('next_of_kin_relationships.next_of_kin_relationship.update', $nextOfKinRelationship->id) }}" id="edit_next_of_kin_relationship_form" name="edit_next_of_kin_relationship_form" accept-charset="UTF-8" class="form-horizontal">
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
                    @include ('pages.settings.next_of_kin_relationships.form', [
                    'nextOfKinRelationship' => $nextOfKinRelationship,
                    ])



                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Save">
                        <a href="{{ route('next_of_kin_relationships.next_of_kin_relationship.index') }}" title="Show All Next Of Kin Relationship">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
</x-base-layout>