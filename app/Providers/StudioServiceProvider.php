<?php

namespace App\Providers;

use App\Helpers\Studios;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class StudioServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('studio', function() {
            return new Studios;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
