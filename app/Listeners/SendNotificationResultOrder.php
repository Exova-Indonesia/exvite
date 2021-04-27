<?php

namespace App\Listeners;

use App\Models\OrderJasa;
use App\Events\OrderResult;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\OrderResultConfirmation;

class SendNotificationResultOrder implements ShouldQueue
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
     * @param  OrderResult  $event
     * @return void
     */
    public function handle(OrderResult $event)
    {
        $data =  OrderJasa::with('customer', 'products.seller.owner', 'details.additionals', 'success', 'revisi')->where('order_id', $event->order['order_id'])->first();
        $data->customer->notify(new OrderResultConfirmation($data));
    }
}
