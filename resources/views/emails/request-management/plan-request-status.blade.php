@component('mail::message')
# Your plan request has changed status

Plan: **{{$plansTransaction->plan->nickname}}**

Status: **{{$plansTransaction->requestStatus->name}}**

Thanks,<br>
{{ config('app.name') }}
@endcomponent