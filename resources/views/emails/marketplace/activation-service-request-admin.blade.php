@component('mail::message')
# A new service activation request has been received

User: **{{$activationServiceTransaction->user->name}}**

Activation Service: **{{$activationServiceTransaction->activationService->name}}**

{{--@component('mail::button', ['url' => ''])
Button Text
@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
