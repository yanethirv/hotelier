<?php

namespace App\Mail\Marketplace;

use App\Models\SubscriptionsTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResumeSubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriptionTransaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SubscriptionsTransaction $subscriptionTransaction)
    {
        $this->subscriptionTransaction = $subscriptionTransaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Resume Subscription')->markdown('emails.marketplace.resume-subscription');
    }
}
