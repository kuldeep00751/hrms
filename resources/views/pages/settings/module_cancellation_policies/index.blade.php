<x-base-layout>

    <div class="col-md-8 mx-auto">

        <div class="card">
            <div class="card">

                <div class="card-header">

                    <div class="pull-left">
                        <a href="/system/settings#finance" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Settings</a>
                    </div>

                    <div class="pull-right" role="group">
                        <a href="{{ route('module_cancellation_policies.module_cancellation_policy.create') }}" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-plus"></i> Add New
                        </a>
                    </div>

                </div>
                <div class="card-body">
                    @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <h6 class="text-success">
                            <i class="fa-solid fa-circle-check text-success"></i>
                            {!! session('success_message') !!}
                        </h6>
                    </div>
                    @endif
                    <div class="table-responsive">

                        <table class="table table-row-dashed" id="kt_datatable_example">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th class="text-center">Academic Year</th>
                                    <th>Study Period</th>
                                    <th>In take</th>
                                    <th>Cancellation Date Range</th>
                                    <th>Percentage</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($moduleCancellationPolicies as $moduleCancellationPolicy)
                                <tr>
                                    <td class="text-center">{{ $moduleCancellationPolicy->academicYear->name }}</td>
                                    <td>{{ $moduleCancellationPolicy->studyPeriod->study_period }}</td>
                                    <td>{{ $moduleCancellationPolicy->academicIntake->name }}</td>
                                    <td>{{ date('d M Y',strtotime($moduleCancellationPolicy->date_from)) }} - {{ date('d M Y',strtotime($moduleCancellationPolicy->date_to)) }}</td>
                                    <td>{{ $moduleCancellationPolicy->cancellation_percentage }}%</td>
                                    <td>
                                        <a href="{{ route('module_cancellation_policies.module_cancellation_policy.edit', $moduleCancellationPolicy->id ) }}" class="btn btn-sm btn-light btn-active-light-primary">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base-layout>