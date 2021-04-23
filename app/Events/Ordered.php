<?php

namespace App\Events;

use App\Models\PaymentDetail;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Ordered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var OrderJasa
     */
    public $order;
    /**
     * Create a new event instance.
     *
     * @param OrderJasa $order
     */
    public function __construct(PaymentDetail $order)
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
