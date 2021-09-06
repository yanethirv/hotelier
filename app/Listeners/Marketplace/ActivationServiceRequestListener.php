<?php

namespace App\Listeners\Marketplace;

use App\Mail\Marketplace\ActivationServiceRequestAdminMail;
use App\Mail\Marketplace\ActivationServiceRequestMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Marketplace\ActivationServiceRequest;
use Illuminate\Support\Facades\Mail;

class ActivationServiceRequestListener
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
            Mail::to($admin->email)->queue(new ActivationServiceRequestAdminMail($event->activationServiceTransaction));
        }

        Mail::to(auth()->user()->email)
            ->queue(new ActivationServiceRequestMail($event->activationServiceTransaction));

       // Mail::to('admin@hotelierhub.test')
        //            ->queue(new ActivationServiceRequestAdminMail($event->activationServiceTransaction));

        Notification::send($superAdmins, new ActivationServiceRequest($event->activationServiceTransaction));
    }
}
