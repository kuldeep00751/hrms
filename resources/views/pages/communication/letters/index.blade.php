<x-base-layout>
    <div class="col-md-12">

        <div class="card">
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <h6>Letters</h6>
                    </div>

                    <div class="pull-right" role="group">
                        <a href="{{ route('communication.letter.create') }}" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-plus"></i> Add New
                        </a>
                    </div>
                </div>

                @if(count($studentLetters) == 0)
                <div class="card-body text-center">
                    <h4>No letters defined.</h4>
                </div>
                @else
                <div class="card-body">
                    @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <h6 class="text-sucstudentLetterscess">
                            <i class="fa-solid fa-circle-check text-success"></i>
                            {!! session('success_message') !!}
                        </h6>
                    </div>
                    @endif
                    <div class="table-responsive">

                        <table class="table table-row-dashed">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                                    <th>Name</th>
                                    <th>Academic Year</th>
                                    <th>Academic Intake</th>
                                    <th>Admission Status</th>
                                    <th>Qualifications</th>
                                    <th>Campus</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($studentLetters as $studentLetter)
                                <tr>
                                    <td>{{ $studentLetter->letter_name }}</td>
                                    <td>{{ $studentLetter->academicYear->name ?? '' }}</td>
                                    <td>
                                        @foreach ($studentLetter->academic_intake_id as $id)
                                        <li>{{ \App\Models\AcademicIntake::find($id)->name }}</li>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if(is_array($studentLetter->admission_status_id))
                                        <ul>
                                            @foreach ($studentLetter->admission_status_id as $status)
                                            <li>{{ \App\Models\AdmissionStatus::where('status', $status)->first()->status ?? 'Pending' }}</li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($studentLetter->qualification_id as $id)
                                            <li>{{ \App\Models\Qualification::find($id)->qualification_name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($studentLetter->campus_id as $id)
                                            <li>{{ \App\Models\Campus::find($id)->name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>

                                        <!--begin::Action menu-->
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen052.svg-->
                                            <i class="bi bi-three-dots fs-3"></i> <!--end::Svg Icon-->
                                        </a>

                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase"><strong>Options</strong></div>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="{{ route('communication.letter.show', $studentLetter->id ) }}" class="menu-link px-3">Preview</a>
                                            </div>

                                            <div class="menu-item px-3">
                                                <a href="{{ route('communication.letter.email', $studentLetter->id ) }}" class="menu-link px-3">Send Email</a>
                                            </div>

                                            <div class="menu-item px-3">
                                                <a href="{{ route('communication.letter.edit', $studentLetter->id ) }}" class="menu-link px-3">Edit Letter</a>
                                            </div>

                                            <div class="menu-item px-3">
                                                <a href="{{ route('communication.letter.delete', $studentLetter->id ) }}" class="menu-link px-3">Delete</a>
                                            </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</x-base-layout>