<?php

namespace App\Http\Controllers;

use App\Jobs\UpdatePaymentStatusJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController
{
    public function __invoke(Request $request)
    {
        if (! $this->isValidMercadoPagoWebhook($request)) {
            Log::warning('Webhook inválido do Mercado Pago');
            return response()->json(['ok' => true], 401);
        }

        $paymentId = $request->input('data.id');

        UpdatePaymentStatusJob::dispatch($paymentId);

        return response()->json(['ok' => true]);
    }

    private function isValidMercadoPagoWebhook(Request $request): bool
    {
        $signature = $request->header('x-signature');
        $requestId = $request->header('x-request-id');

        if (! $signature || ! $requestId) {
            return false;
        }

        // ts=1704908010,v1=hash
        [$tsPart, $hashPart] = explode(',', $signature);

        $ts   = str_replace('ts=', '', $tsPart);
        $hash = str_replace('v1=', '', $hashPart);

        $paymentId = $request->input('data.id')
            ?? $request->query('data.id');

        if (! $paymentId) {
            return false;
        }

        $payload = sprintf(
            'id:%s;request-id:%s;ts:%s;',
            strtolower($paymentId),
            $requestId,
            $ts
        );

        $secret = config('services.mercadopago.webhook_secret');

        $expectedHash = hash_hmac('sha256', $payload, $secret);

        return hash_equals($expectedHash, $hash);
    }

}
