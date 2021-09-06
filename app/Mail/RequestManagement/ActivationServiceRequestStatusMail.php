<?php

namespace App\Mail\RequestManagement;

use App\Models\ActivationServiceTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationServiceRequestStatusMail extends Mailable
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
        return $this->subject('Change of status of your service activation request')->markdown('emails.request-management.activation-service-request-status');
    }
}
