@component('mail::message')
# Estimado {{$invoice->user->name}},

Se ha generado una factura. A continuación los detalles: 

Amount: **{{$invoice->amount}}**.

Description: **{{$invoice->description}}**.

Puede realizar el pago de su factura en el siguiente enlace [Pay Invoice]({{$invoice->hosted_invoice_url}})

Si desea descargar su factura [Download Invoice]({{$invoice->invoice_pdf}})



{{--@component('mail::button', ['url' => ''])
Button Text
@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
