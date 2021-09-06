<?php

namespace App\Listeners\Marketplace;

use App\Mail\Marketplace\ResumeSubscriptionAdminMail;
use App\Mail\Marketplace\ResumeSubscriptionMail;
use App\Models\User;
use App\Notifications\Marketplace\ResumeSubscription;
use App\Notifications\Marketplace\ResumeSubscriptionAdmin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class ResumeSubscriptionListener
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
            Mail::to($admin->email)->queue(new ResumeSubscriptionAdminMail($event->subscriptionTransaction));
        }

        Mail::to($user->email)
            ->queue(new ResumeSubscriptionMail($event->subscriptionTransaction));

        Notification::send($superAdmins, new ResumeSubscriptionAdmin($event->subscriptionTransaction));

        $user->notify(new ResumeSubscription($event->subscriptionTransaction));
    }
}
