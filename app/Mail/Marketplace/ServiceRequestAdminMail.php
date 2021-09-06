<?php

namespace App\Mail\Marketplace;

use App\Models\ServicesTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServiceRequestAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $servicesTransaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ServicesTransaction $servicesTransaction)
    {
        $this->servicesTransaction = $servicesTransaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.marketplace.service-request-admin');
    }
}
