<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
        $this->app->singleton(Gateway::class, function ($app) {
            return new Gateway([
                'environment' => 'sandbox',
                'merchantId' => 'm52fv2wvg4mdqvst',
                'publicKey' => '76j7d74x4rktsvf6',
                'privateKey' => '1d7c54269f95379ca7a350a731581f0d'
            ]);
        });
    }
}
