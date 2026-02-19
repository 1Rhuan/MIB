<?php

use App\Http\Controllers\MercadoPagoWebhookController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->group(function () {

        Route::get('/order/{reference}/status', [OrderController::class, 'status'])
            ->name('order.payment.status');
    }
    );

Route::prefix('webhook')
    ->group(function () {

        Route::post('/payments', MercadoPagoWebhookController::class)
            ->middleware('mercadopago.webhook')
            ->name('webhook.mercadopago.payments');

    });
