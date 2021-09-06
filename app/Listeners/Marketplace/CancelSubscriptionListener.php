<?php

namespace App\Listeners\Marketplace;

use App\Mail\Marketplace\CancelSubscriptionAdminMail;
use App\Mail\Marketplace\CancelSubscriptionMail;
use App\Models\User;
use App\Notifications\Marketplace\CancelSubscription;
use App\Notifications\Marketplace\CancelSubscriptionAdmin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class CancelSubscriptionListener
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
        $superAdmins = User::whereHas('roles', function ($query) {
            $query->where('id', 3);
        })->get();

        $user = User::find(auth()->user()->id);

        foreach ($superAdmins as $admin) {
            Mail::to($admin->email)->queue(new CancelSubscriptionAdminMail($event->subscriptionTransaction));
        }

        Mail::to($user->email)
            ->queue(new CancelSubscriptionMail($event->subscriptionTransaction));

        Notification::send($superAdmins, new CancelSubscriptionAdmin($event->subscriptionTransaction));

        $user->notify(new CancelSubscription($event->subscriptionTransaction));
    }
}
