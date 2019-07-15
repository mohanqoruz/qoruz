@component('mail::message')
# Greetings ,

You have been invited to join Qoruz by {{$user->name}}

@component('mail::button', ['url' => $url])
Accept Invite
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent