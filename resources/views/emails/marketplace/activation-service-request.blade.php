@component('mail::message')
# Dear {{$activationServiceTransaction->user->name}},

We have received your service activation request: **{{$activationServiceTransaction->activationService->name}}**.

You will receive an email when your request changes status.

{{--@component('mail::button', ['url' => ''])
Button Text
@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
