<?php

namespace App\Listeners;

use App\Models\OrderJasa;
use App\Events\OrderSucceed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\OrderSuccessConfirmation;
use App\Notifications\SellerOrderSuccessConfirmation;

class SendNotificationSucceedOrder implements ShouldQueue
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
     * @param  OrderSucceed  $event
     * @return void
     */
    public function handle(OrderSucceed $event)
    {
        $data =  OrderJasa::with('customer', 'products.seller.owner', 'details.additionals', 'success')->where('order_id', $event->order['order_id'])->first();
        $data->customer->notify(new OrderSuccessConfirmation($data));
        $data->products['seller']['owner']->notify(new SellerOrderSuccessConfirmation($data));
    }
}
