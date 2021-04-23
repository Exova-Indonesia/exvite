<?php

namespace App\Listeners;

use App\Events\Ordered;
use App\Notifications\NewOrderSeller;
use App\Notifications\NewOrderCustomer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotificationNewOrder implements ShouldQueue
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
     * @param  Ordered  $event
     * @return void
     */
    public function handle(Ordered $event)
    {
        foreach ($event->order['details'] as $value) {
            $value->products['products']['seller']['owner']->notify(new NewOrderSeller($value));
        }
    }
}
