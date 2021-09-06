<?php

namespace App\Mail\Marketplace;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChargeRefundedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $payload;
    public $data;
    public $description;
    public $customer;
    public $user;
    public $amount_refunded;
    public $brand;
    public $last4;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($payload)
    {
        $this->payload = $payload;
        $this->data = $this->payload['data'];
        $this->customer = $this->data['object']['customer'];
        $this->description = $this->data['object']['description'];
        $this->amount_refunded = $this->data['object']['amount_refunded']/100;
        $this->brand = $this->data['object']['payment_method_details']['card']['brand'];
        $this->last4 = $this->data['object']['payment_method_details']['card']['last4'];
        $this->user = User::where('stripe_id',$this->customer)->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("We've initiated your refund")->markdown('emails.marketplace.charge-refunded');
    }
}
