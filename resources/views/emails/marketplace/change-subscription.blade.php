@component('mail::message')
# Your subscription has changed

Dear {{$subscriptionTransaction->user->name}},

We have received the change of your subscription: **{{$subscriptionTransaction->marketplaceSubscription->subscription_name}}**.

You will receive an email when your subscription changes status.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

