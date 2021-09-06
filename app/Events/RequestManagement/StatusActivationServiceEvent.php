<?php

namespace App\Events\RequestManagement;

use App\Models\ActivationServiceTransaction;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StatusActivationServiceEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $activationServiceTransaction;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ActivationServiceTransaction $activationServiceTransaction)
    {
        $this->activationServiceTransaction = $activationServiceTransaction;
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
