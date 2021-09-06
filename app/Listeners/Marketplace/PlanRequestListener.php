<?php

namespace App\Listeners\Marketplace;

use App\Mail\Marketplace\PlanRequestAdminMail;
use App\Mail\Marketplace\PlanRequestMail;
use App\Models\User;
use App\Notifications\Marketplace\PlanRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class PlanRequestListener
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
            Mail::to($admin->email)->queue(new PlanRequestAdminMail($event->planTransaction));
        }

        Mail::to(auth()->user()->email)
            ->queue(new PlanRequestMail($event->planTransaction));

       // Mail::to('admin@hotelierhub.test')
        //            ->queue(new ActivationServiceRequestAdminMail($event->activationServiceTransaction));

        Notification::send($superAdmins, new PlanRequest($event->planTransaction));
    }
}
