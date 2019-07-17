@component('mail::message')
Greetings {{ $user->name }},


@component('mail::button', ['url' => $url])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent