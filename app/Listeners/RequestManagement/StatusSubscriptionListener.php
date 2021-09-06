<?php

namespace App\Listeners\RequestManagement;

use App\Mail\RequestManagement\SubscriptionRequestStatusMail;
use App\Models\User;
use App\Notifications\RequestManagement\StatusSubscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class StatusSubscriptionListener
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
        $user = User::find($event->subscriptionsTransaction->user->id);

        Mail::to($user)->queue(new SubscriptionRequestStatusMail($event->subscriptionsTransaction));

        $user->notify(new StatusSubscription($event->subscriptionsTransaction));
    }
}
