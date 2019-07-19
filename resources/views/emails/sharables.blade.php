@component('mail::message')
Greetings {{ $user->name }}

{{$sender->name}} has shared the document with you 

@component('mail::button', ['url' => $url])
View Document
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent