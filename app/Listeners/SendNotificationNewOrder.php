<?php

namespace App\Listeners;

use App\Events\Ordered;
use App\Notifications\NewOrderSeller;
use App\Notifications\NewOrderCustomer;
use App\Notifications\NewPendingPayment;
use App\Notifications\NewSuccessPayment;
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
        if($event->order['status'] == 'success') {
            $event->order['customer']->notify(new NewSuccessPayment($event->order));
            foreach ($event->order['details'] as $value) {
                $value->products['products']['seller']['owner']->notify(new NewOrderSeller($value));
            }
        } else if($event->order['status'] == 'pending') {
            $event->order['customer']->notify(new NewPendingPayment($event->order));
        }
    }
}
