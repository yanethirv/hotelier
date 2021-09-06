<?php

namespace App\Mail\Marketplace;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChargeSucceededMail extends Mailable
{
    use Queueable, SerializesModels;

    public $payload;
    public $data;
    public $description;
    public $customer;
    public $user;
    public $amount;

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
        $this->amount = $this->data['object']['amount']/100;
        $this->user = User::where('stripe_id',$this->customer)->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Payment confirmation")->markdown('emails.marketplace.charge-succeeded');
    }
}
