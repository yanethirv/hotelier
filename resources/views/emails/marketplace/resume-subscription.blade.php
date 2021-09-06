@component('mail::message')
# Your subscription has been resumed

Dear {{$subscriptionTransaction->user->name}},

We have received your subscription resumen: **{{$subscriptionTransaction->marketplaceSubscription->subscription_name}}**.

You will receive an email when your subscription changes status.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
