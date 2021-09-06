@component('mail::message')
# Your service activation request has changed status

Activation Service: **{{$activationServiceTransaction->activationService->name}}**

Status: **{{$activationServiceTransaction->requestStatus->name}}**


Thanks,<br>
{{ config('app.name') }}
@endcomponent
