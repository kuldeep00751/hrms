<x-base-layout>

{{ theme()->getView('hr/employees/_form', array('class' => 'mb-5 mb-xl-10', 'employee' => $employee, 'titles' => $titles, 'genderTypes' => $genderTypes, 'nextOfKinRelationships' => $nextOfKinRelationships, 'campus' => $campus, 'designation' => $designation, 'department' => $department, 'employmentStatus' => $employmentStatus, 'countries' => $countries, 'maritalStatuses' => $maritalstatus, 'employeeDocuments' => $employeeDocuments, 'employeerequiredDocuments' => $employeerequiredDocuments, 'maritalStatuses' => $maritalstatus, 'accumulativeleave' => $accumulativeleaves, 'regions' => $regions, 'highest_qualification'=> $highest_qualification, 'banks'=> $banks, 'bank_account_types'=> $bank_account_types)) }}

</x-base-layout>