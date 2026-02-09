<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MercadoPagoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/mercadopago.php',
            'mercadopago'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/mercadopago.php' => config_path('mercadopago.php'),
        ], 'mercadopago-config');
    }
}
