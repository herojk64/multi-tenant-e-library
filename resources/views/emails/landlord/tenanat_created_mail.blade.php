@component('mail::message')
# Your service has been activated
Email: {{$tenant->email}}
Password: {{$password}}

These are the credentials for your admin dashboard. You can modify it as your preferences.

@php
    $fullUrl = 'http://'.$tenant->domain;
@endphp

@component('mail::button', ['url'=>$fullUrl])
Visit
@endcomponent

Thanks,
{{ config('app.name') }}
@component('mail::panel')
Your service has been activated.
@endcomponent
@endcomponent
