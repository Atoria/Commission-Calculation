<?php

namespace App\Providers;

use App\Models\BusinessUser;
use App\Models\PrivateUser;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PrivateUser::class, function ($app){
            return new PrivateUser($app->make('App\Store\RatesStore'));
        });

        $this->app->bind(BusinessUser::class, function ($app){
            return new BusinessUser($app->make('App\Store\RatesStore'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
