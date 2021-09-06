@component('mail::message')
# Dear {{$subscriptionTransaction->user->name}},

We have received your subscription request: **{{$subscriptionTransaction->marketplaceSubscription->subscription_name}}**.

You will receive an email when your request changes status.

{{--@component('mail::button', ['url' => ''])
Button Text
@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
