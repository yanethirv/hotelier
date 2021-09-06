@component('mail::message')
# A new plan request has been received

User: **{{$planTransaction->user->name}}**

Plan: **{{$planTransaction->plan->nickname}}**

Thanks,<br>
{{ config('app.name') }}
@endcomponent