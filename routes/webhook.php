<?php

use App\Http\Controllers\WebhookController;

Route::post('/payments', WebhookController::class)
    ->name('payments');
