@component('mail::message')
# Your service request has changed status

Service: **{{$servicesTransaction->service->name}}**

Status: **{{$servicesTransaction->requestStatus->name}}**

Thanks,<br>
{{ config('app.name') }}
@endcomponent
