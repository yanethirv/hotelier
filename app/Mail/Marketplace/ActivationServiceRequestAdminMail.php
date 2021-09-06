<?php

namespace App\Mail\Marketplace;

use App\Models\ActivationServiceTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationServiceRequestAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $activationServiceTransaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ActivationServiceTransaction $activationServiceTransaction)
    {
        $this->activationServiceTransaction = $activationServiceTransaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Service Activation Request')->markdown('emails.marketplace.activation-service-request-admin');
    }
}
