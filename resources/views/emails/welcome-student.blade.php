@component('mail::message')
# Hello, {{$user->name}}

Thank you for registering to WebAcquire. Verify your email to get access to all the features.

@component('mail::button', ['url' => route('users.verify', $user->verification_token)])
Verify Email
@endcomponent

Thanks,<br>
Team {{ config('app.name') }}
@endcomponent
