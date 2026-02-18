<?php

namespace App\Http\Controllers;

use App\Jobs\UpdatePaymentStatusJob;
use Illuminate\Http\Request;

class MercadoPagoWebhookController
{
    /**
     * Invoke the class instance.
     */
    public function __invoke(Request $request)
    {
        if ($request->input('type') !== 'payment') {
            return response()->noContent(200);
        }

        if ($request->input('action') !== 'payment.updated') {
            return response()->noContent(200);
        }

        $paymentId = $request->input('data.id');
        UpdatePaymentStatusJob::dispatch($paymentId);

        return response()->noContent(200);
    }
}
