<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\WebhookController;

Route::prefix('v1')->group(
     function () {
        Route::post('/orders', [OrderController::class, 'create'])
            ->name('orders.create');

        Route::post('/order/create', [OrderController::class, 'create'])
            ->name('order.create');
    }
);
