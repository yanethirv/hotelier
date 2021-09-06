@component('mail::message')
# User resumed subscription

User: **{{$subscriptionTransaction->user->name}}**

Subscription: **{{$subscriptionTransaction->marketplaceSubscription->subscription_name}}**

Thanks,<br>
{{ config('app.name') }}
@endcomponent