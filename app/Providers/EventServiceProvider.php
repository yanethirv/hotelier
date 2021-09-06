<?php

namespace App\Providers;

use App\Events\Marketplace\ActivationServiceRequestEvent;
use App\Events\Marketplace\CancelSubscriptionEvent;
use App\Events\Marketplace\ChangeSubscriptionEvent;
use App\Events\Marketplace\ChargeSucceededEvent;
use App\Events\Marketplace\PlanRequestEvent;
use App\Events\Marketplace\ResumeSubscriptionEvent;
use App\Events\Marketplace\ServiceRequestEvent;
use App\Events\Marketplace\SubscriptionRequestEvent;
use App\Events\RequestManagement\StatusActivationServiceEvent;
use App\Events\RequestManagement\StatusPlanEvent;
use App\Events\RequestManagement\StatusServiceEvent;
use App\Events\RequestManagement\StatusSubscriptionEvent;
use App\Listeners\Marketplace\ActivationServiceRequestListener;
use App\Listeners\Marketplace\CancelSubscriptionListener;
use App\Listeners\Marketplace\ChangeSubscriptionListener;
use App\Listeners\Marketplace\ChargeSucceededListener;
use App\Listeners\Marketplace\PlanRequestListener;
use App\Listeners\Marketplace\ResumeSubscriptionListener;
use App\Listeners\Marketplace\ServiceRequestListener;
use App\Listeners\Marketplace\SubscriptionRequestListener;
use App\Listeners\RequestManagement\StatusActivationServiceListener;
use App\Listeners\RequestManagement\StatusPlanListener;
use App\Listeners\RequestManagement\StatusServiceListener;
use App\Listeners\RequestManagement\StatusSubscriptionListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ActivationServiceRequestEvent::class => [
            ActivationServiceRequestListener::class,
        ],
        StatusActivationServiceEvent::class => [
            StatusActivationServiceListener::class,
        ],
        ChargeSucceededEvent::class => [
            ChargeSucceededListener::class,
        ],
        ServiceRequestEvent::class => [
            ServiceRequestListener::class,
        ],
        StatusServiceEvent::class => [
            StatusServiceListener::class,
        ],
        PlanRequestEvent::class => [
            PlanRequestListener::class,
        ],
        StatusPlanEvent::class => [
            StatusPlanListener::class,
        ],
        SubscriptionRequestEvent::class => [
            SubscriptionRequestListener::class,
        ],
        StatusSubscriptionEvent::class => [
            StatusSubscriptionListener::class,
        ],
        ChangeSubscriptionEvent::class => [
            ChangeSubscriptionListener::class,
        ],
        CancelSubscriptionEvent::class => [
            CancelSubscriptionListener::class,
        ],
        ResumeSubscriptionEvent::class => [
            ResumeSubscriptionListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
