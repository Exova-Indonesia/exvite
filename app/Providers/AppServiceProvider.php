<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\Studio;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('owner', function () {
            if(! empty($this->app->request->route('slug'))) {
                $studio = Studio::where([
                    ['name', str_replace('-', ' ', $this->app->request->route('slug'))],
                    ['user_id', auth()->user()->id],
                    ])->first();
                if($studio) {
                    return 0;
                }
            } else {
                return 1;
            }
        });
    }


    // Traffic Limiter

    protected function configureRateLimiting()
{
    RateLimiter::for('global', function (Request $request) {
        return Limit::perMinute(18);
    });
}
}
