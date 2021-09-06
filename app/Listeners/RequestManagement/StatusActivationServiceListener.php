<?php

namespace App\Listeners\RequestManagement;

use App\Mail\RequestManagement\ActivationServiceRequestStatusMail;
use App\Models\User;
use App\Notifications\RequestManagement\StatusActivationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class StatusActivationServiceListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        $user = User::find($event->activationServiceTransaction->user->id);

        Mail::to($user)->queue(new ActivationServiceRequestStatusMail($event->activationServiceTransaction));

        $user->notify(new StatusActivationService($event->activationServiceTransaction));
    }
}
