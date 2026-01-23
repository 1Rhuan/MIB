<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController
{
    public function __invoke(Request $request)
    {
        Log::info('Mercado Pago WebhookController recebido', [
            'headers' => $request->headers->all(),
            'payload' => $request->all(),
        ]);

        return response()->json(['ok' => true]);
    }
}
