<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WebhookController;

Route::post("pay", [CheckoutController::class, "store"])->name('pay');

Route::post("webhooks/payments", WebhookController::class)
    ->name('webhooks.payments');

Route::get("payments/{id}", [CheckoutController::class, "getPayment"])->name('payments');
