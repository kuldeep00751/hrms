<x-base-layout>
    <div class="col-md-8 mx-auto">

        <div class="card">
            <div class="card">
                <div class="card-header">
                    <div class="pull-right">
                        <a href="{{ route('communication.letter.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Letters</a>
                    </div>

                    <div class="pull-left">
                        <a href="{{ route('communication.letter.pdf', $studentLetter->id) }}" target="_blank" class="btn btn-sm btn-secondary btn-active-light-info"><i class="fa-solid fa-eye"></i> Preview PDF</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="alert alert-warning text-black">
                        <h6 class="text-black">Please note:</h6>
                        This letter will be send to a total of <strong>{{$applicationCount}}</strong> student(s) with <strong>{{implode(', ',$studentLetter->admission_status_id)}}</strong> status who have applied for:
                        <ul>
                            @foreach($studentLetter->qualification_id as $key => $value )
                            <li><strong>{{ \App\Models\Qualification::find($value)->qualification_name }}</strong></li>
                            @endforeach
                        </ul>
                        at the following campus(es)
                        <ul>
                            @foreach($studentLetter->campus_id as $key => $value )
                            <li><strong>{{ \App\Models\Campus::find($value)->name }}</strong></li>
                            @endforeach
                        </ul>
                        For the <strong>{{ $studentLetter->academicYear->name}}</strong> academic year and <strong>{{ $studentLetter->academicIntake->name}}</strong>
                    </div>
                    <div class="alert alert-warning text-black">
                        <h6 class="text-black">Email Preview:</h6>
                        <p>Dear Student Name,</p>

                        <p>We are emailing you your <strong>{{$studentLetter->letter_name}}</strong> for <strong>Qualification Name</strong> you applied at <strong>{{ config('app.name') }}</strong>. Thank you for taking the time to submit your application and express your interest in joining our community.</p>

                        <p>Below is a download link for your letter for safe keeping.</p>

                        <button class="btn btn-sm btn-secondary">
                            Download {{$studentLetter->letter_name}}
                        </button>


                        <p>Best regards,</p>

                        {{ config('app.name') }}
                    </div>
                    <div class="bg-light p-5 rounded border">
                        {!! $studentLetter->generateLetter($studentLetter->content, $letterParameters) !!}
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-base-layout>