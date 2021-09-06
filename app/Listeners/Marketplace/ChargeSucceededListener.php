<?php

namespace App\Listeners\Marketplace;

use App\Models\User;
use App\Notifications\Marketplace\ChargeSucceeded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\InteractsWithQueue;

class ChargeSucceededListener
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

        //foreach ($superAdmins as $admin) {
        //    Mail::to($admin->email)->queue(new ActivationServiceRequestAdminMail($event->activationServiceTransaction));
        //}

        //Mail::to(auth()->user()->email)
        //    ->queue(new ActivationServiceRequestMail($event->activationServiceTransaction));

       // Mail::to('admin@hotelierhub.test')
        //            ->queue(new ActivationServiceRequestAdminMail($event->activationServiceTransaction));

        Notification::send($superAdmins, new ChargeSucceeded($event->payload));
    }
}
