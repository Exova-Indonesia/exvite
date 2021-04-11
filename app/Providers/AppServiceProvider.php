<?php

namespace App\Providers;

use App\Helpers\Studios;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\Studio;
use App\Models\StudioLover;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
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
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('lover', function () {
        if(! empty($this->app->request->route('slug'))) {
            $studio = Studio::where([
                ['name', str_replace('-', ' ', $this->app->request->segment(2))]
                ])->first();
            $lover = StudioLover::where([
                ['studio_id', $studio->id ?? ''],
                ['customer_id', auth()->user()->id],
                ])->first();
            if($lover) {
                    return 1;
                }
            } else {
                return 0;
            }
        });

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
