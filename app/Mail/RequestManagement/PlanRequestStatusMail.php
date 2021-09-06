<?php

namespace App\Mail\RequestManagement;

use App\Models\PlansTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlanRequestStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $plansTransaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PlansTransaction $plansTransaction)
    {
        $this->plansTransaction = $plansTransaction;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Change of status of your plan request')->markdown('emails.request-management.plan-request-status');
    }
}
