@component('mail::message')
# Estimado {{$invoice->user->name}},

El pago de su factura ha sido verificado y confirmado con exito. A continuación los detalles: 

Amount: **{{$invoice->amount}}**.

Description: **{{$invoice->description}}**.

Si desea descargar su factura [Download Invoice]({{$invoice->invoice_pdf}})

{{--@component('mail::button', ['url' => ''])
Button Text
@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
