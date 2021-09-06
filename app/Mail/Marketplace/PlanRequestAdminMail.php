<?php

namespace App\Mail\Marketplace;

use App\Models\PlansTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlanRequestAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $planTransaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PlansTransaction $planTransaction)
    {
        $this->planTransaction = $planTransaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Plan Request')->markdown('emails.marketplace.plan-request-admin');
    }
}
