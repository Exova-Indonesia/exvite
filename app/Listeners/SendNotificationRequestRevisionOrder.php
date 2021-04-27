<?php

namespace App\Listeners;

use App\Models\OrderJasa;
use App\Events\OrderRequestRevision;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\SellerOrderRequestRevisionConfirmation;

class SendNotificationRequestRevisionOrder implements ShouldQueue
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
     * @param  OrderRequestRevision  $event
     * @return void
     */
    public function handle(OrderRequestRevision $event)
    {
        $data =  OrderJasa::with('customer', 'products.seller.owner', 'details.additionals', 'success', 'revisi')->where('order_id', $event->order['order_id'])->first();
        $data->products['seller']['owner']->notify(new SellerOrderRequestRevisionConfirmation($data));
    }
}
