<?php

namespace App\Listeners\RequestManagement;

use App\Mail\RequestManagement\ServiceRequestStatusMail;
use App\Models\User;
use App\Notifications\RequestManagement\StatusService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class StatusServiceListener
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
        $user = User::find($event->servicesTransaction->user->id);

        Mail::to($user)->queue(new ServiceRequestStatusMail($event->servicesTransaction));

        $user->notify(new StatusService($event->servicesTransaction));
    }
}
