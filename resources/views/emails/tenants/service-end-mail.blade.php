@component('mail::message')
# Your Service is Ended

Hello {{ $user->name }},

We wanted to inform you that your service subscription ended. Please review the details below and consider adding service to continue uninterrupted service.

### Service Details:
- **Service**: {{ $service->title }}
- **Type**: {{ ucfirst($service->type) }} ({{ $service->duration }} {{ $service->type === \App\Enum\ServicesType::MONTHLY ? 'month(s)' : 'year(s)' }})

To avoid any disruption, we recommend renewing your service before the expiration date.

If you have any questions or need help with your service, feel free to contact us.

Thanks for staying with us!

Best regards,<br>
{{ config('app.name') }}

@component('mail::panel')
Your service is ended. Please take buy service to keep using the features.
@endcomponent
@endcomponent