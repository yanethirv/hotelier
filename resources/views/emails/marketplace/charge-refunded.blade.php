@component('mail::message')
<div align="center"><b>YOUR REFUND HAS BEEN INITIATED</b></div>

<br>

Hello {{$user->name}},

This is a notificacion to confirm that we have successfully processed a **${{$amount_refunded}}** refund for your purchase of **{{$description}}**.

We will automatically credit the funds to your **{{$brand}} ending {{$last4}}**.

Please note, that it might take up to 5 business days for the money to appear back in your account.


Thanks,<br>
**{{ config('app.name') }}**
@endcomponent
