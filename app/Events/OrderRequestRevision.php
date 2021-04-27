<?php

namespace App\Events;

use App\Models\OrderRevision;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderRequestRevision
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var OrderRevision
     */
    public $order;
    /**
     * Create a new event instance.
     *
     * @param OrderRevision $order
     */
    public function __construct(OrderRevision $order)
    {
        $this->order = $order;
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
