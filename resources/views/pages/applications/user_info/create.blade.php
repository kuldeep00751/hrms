<x-base-layout>


    {{ theme()->getView('pages/account/settings/_profile-details', array('class' => 'mb-5 mb-xl-10', 'info' => $info, 'titles' => $titles, 'genderTypes' => $genderTypes, 'nextOfKinRelationships' => $nextOfKinRelationships, 'educationSystems' => $educationSystems, 'userSchoolSubjects' => $userSchoolSubjects, 'schoolSubjects' => $schoolSubjects, 'matricTypes' => $matricTypes, 'gradingScale' => $gradingScale, 'qualifications' => $qualifications, 'academicIntake' => $academicIntake, 'studyModes' => $studyModes, 'campus' => $campus, 'countries' => $countries, 'applicationTypes' => $applicationTypes, 'studentTypes' => $studentTypes, 'choice_number' => $choice_number, 'qualifications' => $qualifications, 'allowApplicatioNSubmission' => $allowApplicatioNSubmission,'applicationAcademicProcess' => $applicationAcademicProcess, 'campuses' => $campuses, 'requiredDocuments' => $requiredDocuments, 'applications' => $applications, 'studentDocuments' => $studentDocuments)) }}

    {{-- {{ theme()->getView('pages/account/settings/_signin-method', array('class' => 'mb-5 mb-xl-10', 'info' => $info)) }} --}}

</x-base-layout>