@component('mail::message')
# Your subscription has been cancelled

Dear {{$subscriptionTransaction->user->name}},

We have received your subscription cancellation: **{{$subscriptionTransaction->marketplaceSubscription->subscription_name}}**.

You will receive an email when your subscription changes status.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
