@component('mail::message')
# A new service request has been received

User: **{{$servicesTransaction->user->name}}**

Service: **{{$servicesTransaction->service->name}}**

{{--@component('mail::button', ['url' => ''])
Button Text
@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent