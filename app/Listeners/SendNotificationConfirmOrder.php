<?php

namespace App\Listeners;

use App\Events\OrderConfirm;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\OrderAcceptedConfirmation;
use App\Notifications\OrderRejectedConfirmation;

class SendNotificationConfirmOrder implements ShouldQueue
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
     * @param  OrderConfirm  $event
     * @return void
     */
    public function handle(OrderConfirm $event)
    {
        if($event->order['status'] == 'pesanan_diproses') {
            $event->order['customer']->notify(new OrderAcceptedConfirmation($event->order));
        }
    }
}
