<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::prefix('/checkout')
    ->group(function () {

    Route::get('/{slug}', [CheckoutController::class, 'show'])
        ->name('checkout.show');

    Route::post('/process', [CheckoutController::class, 'process'])
        ->name('checkout.process');
});

Route::prefix('/pagamento')->group(function () {
    Route::get('/pedido/{reference}', [PaymentController::class, 'show'])
        ->name('order.payment');
});
