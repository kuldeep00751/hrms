 <table>
     <thead>
         <tr>
             <th colspan="12" class="text-center"><strong>Student Information</strong></th>
             <th colspan="2" class="text-center"><strong>Disability Information</strong></th>
             <th colspan="8" class="text-center"><strong>Application Information</strong></th>
             <th colspan="{{ $requiredDocuments->count()}}" class="text-center"><strong>Student Documents</strong></th>
         </tr>
         <tr class="text-gray-400 fw-bold text-uppercase">
             <th><strong>Academic Year</strong></th>
             <th><strong>Student Number</strong></th>
             <th><strong>First Names</strong></th>
             <th><strong>Surname</strong></th>
             <th><strong>Date of Birth</strong></th>
             <th><strong>ID Number</strong></th>
             <th><strong>Mobile Number</strong></th>
             <th><strong>Email</strong></th>
             <th><strong>Citizenship</strong></th>
             <th><strong>Last School Attended</strong></th>
             <th><strong>Highest Grade</strong></th>
             <th><strong>Year Completed</strong></th>

             <th><strong>Chronic Illness</strong></th>
             <th><strong>Disabilities</strong></th>

             <th><strong>Qualification Name</strong></th>
             <th><strong>Qualification Code</strong></th>
             <th><strong>Choice Number</strong></th>
             <th><strong>Application Type</strong></th>
             <th><strong>Academic Intake</strong></th>
             <th><strong>Campus</strong></th>
             <th><strong>Study Mode</strong></th>
             <th><strong>Application Status</strong></th>
             @foreach($requiredDocuments as $requiredDocument)
             <th>
                 <strong> {{ $requiredDocument->document_name }}</strong>
             </th>
             @endforeach
         </tr>
     </thead>
     <tbody>
         @foreach($applications as $application)
         <tr>
             <td>{{ $application->academicYear->name }}</td>
             <td>{{ $application->userInfo->student_number }}</td>
             <td>{{ $application->userInfo->first_names }}</td>
             <td>{{ $application->userInfo->surname }}</td>
             <td>{{ $application->userInfo->date_of_birth }}</td>
             <td>{{ $application->userInfo->id_number }}</td>
             <td>{{ $application->userInfo->mobile_number }}</td>
             <td>{{ $application->userInfo->email_address }}</td>
             <td>{{ $application->userInfo->citizenship_status }}</td>
             <td>{{ $application->userInfo->last_school_attended }}</td>
             <td>{{ $application->userInfo->highest_grade }}</td>
             <td>{{ $application->userInfo->year_completed }}</td>

             <td>
                 @php
                 $healthQuestionnaire = $healthQuestionnaires->where('user_info_id', $application->user_info_id)->first();
                 @endphp
                 @if($healthQuestionnaire)
                 {{$healthQuestionnaire->chronic_illness_description}}
                 @else
                 N/A
                 @endif

             </td>
             <td>
                 @if($healthQuestionnaire)
                 {{$healthQuestionnaire->disability_description}}
                 @else
                 N/A
                 @endif
             </td>

             <td>{{ $application->qualification->qualification_name }}</td>
             <td>{{ $application->qualification->qualification_code }}</td>
             <td>{{ $application->choice_number }}</td>
             <td>{{ $application->applicationType->application_type }}</td>
             <td>{{ $application->academicIntake->name }}</td>
             <td>{{ $application->campus->name }}</td>

             <td>{{ $application->studyMode->study_mode }}</td>
             <td>{{ $application->application_status }}</td>
             @foreach($requiredDocuments as $requiredDocument)
             @php
             
             $studentDocument = $studentDocuments->where('required_document_id', $requiredDocument->id)
             ->where('user_info_id', $application->user_info_id)
             ->first();
             
             @endphp
             <td>
                 @if($studentDocument)
                 <a href="{{ route('admission.application.download-excel', $studentDocument->id) }}">
                     Download
                 </a>
                 @else
                    N/A
                 @endif
             </td>
             @endforeach
         </tr>
         @endforeach
     </tbody>
 </table>