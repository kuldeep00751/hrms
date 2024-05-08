<x-mail::message>
Dear {{$application->userInfo->title->title}} {{$application->userInfo->first_names}} {{$application->userInfo->surname}},

We are emailing you your **{{$letter->letter_name}}** for **{{$application->qualification->qualification_name}}** you applied at **{{ config('app.name') }}**. 
Thank you for taking the time to submit your application and express your interest in joining our community.

Below is a download link of your letter for safe keeping.

<x-mail::button :url="$downloadUrl">
    Download {{$letter->letter_name}}
</x-mail::button>

Best regards

{{ config('app.name') }}
</x-mail::message>