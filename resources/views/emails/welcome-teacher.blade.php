@component('mail::message')
# Hello, {{$user->name}}

Thank you for contributing in WebAcquire as a teacher. Please verify your email by clicking on the button below for further process.Once your Identity is verified by our team you will get access to teach students, conduct quizes and many more. We will notify you soon about account approval status.

@component('mail::button', ['url' => route('users.verify', $user->verification_token)])
Verify Email
@endcomponent

Thanks,<br>
Team {{ config('app.name') }}
@endcomponent
