@component('mail::message')
<div align="center"><b>YOUR PAYMENT HAS BEEN RECEIVED</b></div>

<br>

Hello {{$user->name}},

Thank you for payment: **{{$description}}**.

We've successfully processed your payment of **${{$amount}}**.


Thanks,<br>
**{{ config('app.name') }}**
@endcomponent