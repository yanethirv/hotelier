@component('mail::message')
# Dear {{$planTransaction->user->name}},

We have received your plan request: **{{$planTransaction->plan->nickname}}**.

You will receive an email when your request changes status.

{{--@component('mail::button', ['url' => ''])
Button Text
@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
