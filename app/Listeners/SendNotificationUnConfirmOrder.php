<?php

namespace App\Listeners;

use App\Models\Wallet;
use App\Models\OrderJasa;
use App\Events\OrderUnConfirm;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\OrderCanceledConfirmation;
use App\Notifications\OrderRejectedConfirmation;
use App\Notifications\OrderAutoCancelConfirmation;
use App\Notifications\SellerOrderAutoCancelConfirmation;

class SendNotificationUnConfirmOrder implements ShouldQueue
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
     * @param  OrderUnConfirm  $event
     * @return void
     */
    public function handle(OrderUnConfirm $event)
    {
        $data =  OrderJasa::with('customer', 'products.seller.owner', 'details.additionals', 'details.payments')->where('order_id', $event->order['order_id'])->first();
        if($event->order['status'] == 'pesanan_ditolak') {
            $data->customer->notify(new OrderRejectedConfirmation($data));
        } else if($event->order['status'] == 'batal_otomatis') {
            $data->customer->notify(new OrderAutoCancelConfirmation($data));
            $data->products['seller']['owner']->notify(new SellerOrderAutoCancelConfirmation($data));
        } else if($event->order['status'] == 'pesanan_dibatalkan') {
            $data->customer->notify(new OrderCanceledConfirmation($data));
        }
    }
}
