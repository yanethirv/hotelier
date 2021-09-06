@component('mail::message')
# A new subscription request has been received

User: **{{$subscriptionTransaction->user->name}}**

Subscription: **{{$subscriptionTransaction->marketplaceSubscription->subscription_name}}**

Thanks,<br>
{{ config('app.name') }}
@endcomponent