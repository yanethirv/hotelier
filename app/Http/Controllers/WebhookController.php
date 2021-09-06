<?php

namespace App\Http\Controllers;

use App\Events\Marketplace\ChargeSucceededEvent;
use App\Mail\Marketplace\ChargeRefundedMail;
use App\Mail\Marketplace\ChargeSucceededMail;
use App\Mail\Marketplace\FeeInvoicePaidMail;
use App\Models\FeeInvoice;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Response;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class WebhookController extends CashierController
{
    /**
     * Handle invoice payment succeeded.
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function customerSubscriptionCreated($payload)
    {
        // Handle the incoming event...
    }

    public function handleInvoicePaid($payload)
    {
        $invoiceId = $payload['data']['object']['id'];
        
        $invoice = FeeInvoice::where('stripe_id',$invoiceId)->first();

        if ($invoice) {
            $invoice->status = 'paid';
            
            $invoice->save();
        }
    }

    public function handleChargeRefunded($payload)
    {
        try {

            $customer = $payload['data']['object']['customer'];
            $user = User::where('stripe_id',$customer)->first();

            Mail::to($user->email)
                ->queue(new ChargeRefundedMail($payload));

            
            return new Response('Webhook Handled', 200);

        } catch (\Exception $exception) {

            Log::debug($exception->getMessage());

            return new Response('Webhook Unhandled', $exception->getCode());

        }
    }

    /**
     *
     * WEBHOOK que se encarga de obtener un evento al hacer un pago correctamente
     * charge.refunded
     *
     * @param array $payload
     * @return Response|\Symfony\Component\HttpFoundation\Response
     */
    public function handleChargeSucceeded($payload) {
        try {

            $customer = $payload['data']['object']['customer'];
            $user = User::where('stripe_id',$customer)->first();

            Mail::to($user->email)
                ->queue(new ChargeSucceededMail($payload));

            //event(new ChargeSucceededEvent($payload));

            return new Response('Webhook Handled', 200);
        
        } catch (\Exception $exception) {
            Log::debug("Excepción Webhook {handleChargeSucceeded}: " . $exception->getMessage() . ", Line: " . $exception->getLine() . ', File: ' . $exception->getFile());
            return new Response('Webhook Handled with error', 400);
        }
    }
}