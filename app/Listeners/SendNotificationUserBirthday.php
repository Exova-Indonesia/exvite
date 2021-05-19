<?php

namespace App\Listeners;

use App\Events\UserBirthday;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\UserBirthdayGreetings;

class SendNotificationUserBirthday implements ShouldQueue
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
     * @param  UserBirthday  $event
     * @return void
     */
    public function handle(UserBirthday $event)
    {
        $event->notify(new UserBirthdayGreetings($event));
    }
}
