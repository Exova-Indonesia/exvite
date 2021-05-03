<?php

namespace App\Listeners;

use App\Events\Messaged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\MessageSent;

class SendMessageNotification implements ShouldQueue
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
     * @param  Messaged  $event
     * @return void
     */
    public function handle(Messaged $event)
    {
        $event->target->notify(new MessageSent($event));
    }
}
