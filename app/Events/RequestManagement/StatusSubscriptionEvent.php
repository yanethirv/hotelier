<?php

namespace App\Events\RequestManagement;

use App\Models\SubscriptionsTransaction;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StatusSubscriptionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $subscriptionsTransaction;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(SubscriptionsTransaction $subscriptionsTransaction)
    {
        $this->subscriptionsTransaction = $subscriptionsTransaction;
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
