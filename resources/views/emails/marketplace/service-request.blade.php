@component('mail::message')
# Dear {{$servicesTransaction->user->name}},

We have received your service request: **{{$servicesTransaction->service->name}}**.

You will receive an email when your request changes status.

{{--@component('mail::button', ['url' => ''])
Button Text
@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
