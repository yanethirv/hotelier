@component('mail::message')
# Your subscription request has changed status

Subscription: **{{$subscriptionsTransaction->marketplaceSubscription->subscription_name}}**

Status: **{{$subscriptionsTransaction->requestStatus->name}}**

Thanks,<br>
{{ config('app.name') }}
@endcomponent
