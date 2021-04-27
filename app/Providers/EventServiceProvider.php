<?php

namespace App\Providers;

use App\Events\Ordered;
use App\Events\OrderResult;
use App\Events\OrderConfirm;
use App\Events\OrderSucceed;
use App\Events\OrderUnConfirm;
use App\Events\OrderRequestRevision;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendNotificationNewOrder;
use App\Listeners\SendNotificationResultOrder;
use App\Listeners\SendNotificationConfirmOrder;
use App\Listeners\SendNotificationSucceedOrder;
use App\Listeners\SendNotificationUnConfirmOrder;
use App\Listeners\SendNotificationRequestRevisionOrder;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Ordered::class => [
            SendNotificationNewOrder::class,
        ],
        OrderConfirm::class => [
            SendNotificationConfirmOrder::class,
        ],
        OrderUnConfirm::class => [
            SendNotificationUnConfirmOrder::class,
        ],
        OrderSucceed::class => [
            SendNotificationSucceedOrder::class,
        ],
        OrderRequestRevision::class => [
            SendNotificationRequestRevisionOrder::class,
        ],
        OrderResult::class => [
            SendNotificationResultOrder::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
