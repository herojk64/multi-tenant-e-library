@component('mail::message')
# Reset Your Password

We received a request to reset your password for your account.

@component('mail::button', ['url' => route($url,$token)])
Reset Password
@endcomponent

If you did not request a password reset, no further action is required.

Thanks,
{{ config('app.name') }}

@component('mail::panel')
This is a secure link for resetting your password. It will expire in 60 minutes.
@endcomponent
@endcomponent
