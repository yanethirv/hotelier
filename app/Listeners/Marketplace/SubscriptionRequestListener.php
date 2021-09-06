<?php

namespace App\Listeners\Marketplace;

use App\Mail\Marketplace\SubscriptionRequestAdminMail;
use App\Mail\Marketplace\SubscriptionRequestMail;
use App\Models\User;
use App\Notifications\Marketplace\SubscriptionRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Laravel\Cashier\Subscription;

class SubscriptionRequestListener
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

        foreach ($superAdmins as $admin) {
            Mail::to($admin->email)->queue(new SubscriptionRequestAdminMail($event->subscriptionTransaction));
        }

        Mail::to(auth()->user()->email)
            ->queue(new SubscriptionRequestMail($event->subscriptionTransaction));

       // Mail::to('admin@hotelierhub.test')
        //            ->queue(new ActivationServiceRequestAdminMail($event->activationServiceTransaction));

        Notification::send($superAdmins, new SubscriptionRequest($event->subscriptionTransaction));
    }
}
