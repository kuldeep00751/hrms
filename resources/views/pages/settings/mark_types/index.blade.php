<x-base-layout>
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <a href="/system/settings#assessments" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                </div>
                <div class="pull-right">
                    <a href="{{ route('mark_types.mark_type.create') }}" class="btn btn-sm btn-primary" title="Create New Assessment Mark type">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                </div>
            </div>

            @if(count($markTypes) == 0)
            <div class="card-body text-center">
                <h4>No Assessment mark types Available.</h4>
            </div>
            @else
            <div class="card-body pt-6">
                @if(Session::has('success_message'))
                <div class="alert alert-success">
                    <h6 class="text-success">
                        <i class="fa-solid fa-circle-check text-success"></i>
                        {!! session('success_message') !!}
                    </h6>
                </div>
                @endif
                <div class="table-responsive">

                    <table class="table table-row-dashed">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                <th>Mark Type</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($markTypes as $markType)
                            <tr>
                                <td>{{ $markType->mark_type }}</td>
                                <td>
                                    <a href="{{ route('mark_types.mark_type.edit', $markType->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                {!! $markTypes->render() !!}
            </div>

            @endif

        </div>
    </div>
</x-base-layout>