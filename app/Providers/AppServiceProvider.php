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

        Blade::if('products', function () {
            if($this->app->request->segment(1) == 'products') {
                return 0;
            } else {
                return 1;
            }
        });

        Blade::if('cart', function () {
            if($this->app->request->segment(1) == 'cart') {
                return 0;
            } else {
                return 1;
            }
        });

        Blade::if('basemenu', function () {
            $url = $this->app->request->segment(1);
            $url2 = $this->app->request->segment(2);
            if(($url == 'profile') || ($url == 'notifications') || ( $url == '')) {
                return 1;
            } else {
                return 0;
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
