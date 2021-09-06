<?php

namespace App\Mail\RequestManagement;

use App\Models\SubscriptionsTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionRequestStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriptionsTransaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SubscriptionsTransaction $subscriptionsTransaction)
    {
        $this->subscriptionsTransaction = $subscriptionsTransaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Change of status of your subscription request')->markdown('emails.request-management.subscription-request-status');
    }
}
