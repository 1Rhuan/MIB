<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\WebhookController;

Route::post('/orders', [OrderController::class, 'create'])
    ->name('orders.create');

Route::post("webhooks/payments", WebhookController::class)
    ->name('webhooks.payments');

Route::post('order/create', [OrderController::class, 'create'])
    ->name('order.create');

