<?php

namespace App\Listeners\Marketplace;

use App\Mail\Marketplace\ChangeSubscriptionAdminMail;
use App\Mail\Marketplace\ChangeSubscriptionMail;
use App\Models\User;
use App\Notifications\Marketplace\ChangeSubscription;
use App\Notifications\Marketplace\ChangeSubscriptionAdmin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class ChangeSubscriptionListener
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
            Mail::to($admin->email)->queue(new ChangeSubscriptionAdminMail($event->subscriptionTransaction));
        }

        Mail::to($user->email)
            ->queue(new ChangeSubscriptionMail($event->subscriptionTransaction));

        Notification::send($superAdmins, new ChangeSubscriptionAdmin($event->subscriptionTransaction));

        $user->notify(new ChangeSubscription($event->subscriptionTransaction));
        
    }
}
