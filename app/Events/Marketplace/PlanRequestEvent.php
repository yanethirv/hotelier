<?php

namespace App\Events\Marketplace;

use App\Models\PlansTransaction;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlanRequestEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $planTransaction;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PlansTransaction $planTransaction)
    {
        $this->planTransaction = $planTransaction;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
