<?php

namespace App\Listeners\RequestManagement;

use App\Mail\RequestManagement\PlanRequestStatusMail;
use App\Models\User;
use App\Notifications\RequestManagement\StatusPlan;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class StatusPlanListener
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
        $user = User::find($event->plansTransaction->user->id);

        Mail::to($user)->queue(new PlanRequestStatusMail($event->plansTransaction));

        $user->notify(new StatusPlan($event->plansTransaction));
    }
}
