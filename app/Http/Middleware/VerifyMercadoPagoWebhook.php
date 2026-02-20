<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyMercadoPagoWebhook
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $this->isValid($request)) {
            return response()->json(['ok' => false], 401);
        }

        return $next($request);
    }

    private function isValid(Request $request): bool
    {
        $signatureData = $this->extractSignature($request);

        if (! $signatureData) {
            return false;
        }

        $paymentId = $this->extractPaymentId($request);

        if (! $paymentId) {
            return false;
        }

        return $this->verifyHash(
            paymentId: $paymentId,
            requestId: $request->header('x-request-id'),
            timestamp: $signatureData['ts'],
            receivedHash: $signatureData['hash'],
        );
    }

    private function extractSignature(Request $request): ?array
    {
        $signature = $request->header('x-signature');
        $requestId = $request->header('x-request-id');

        if (! $signature || ! $requestId) {
            return null;
        }

        $parts = collect(explode(',', $signature))
            ->map(fn ($item) => explode('=', trim($item)))
            ->mapWithKeys(fn ($item) => [$item[0] => $item[1] ?? null]);

        $ts = $parts['ts'] ?? null;
        $hash = $parts['v1'] ?? null;

        if (! $ts || ! $hash) {
            return null;
        }

        return [
            'ts' => (int) $ts,
            'hash' => $hash,
        ];
    }

    private function extractPaymentId(Request $request): ?string
    {
        return $request->input('data.id')
            ?? $request->query('data.id');
    }

    private function verifyHash(
        string $paymentId,
        string $requestId,
        int $timestamp,
        string $receivedHash
    ): bool {
        $secret = config('mercadopago.webhook_secret');

        if (! $secret) {
            return false;
        }

        $payload = sprintf(
            'id:%s;request-id:%s;ts:%s;',
            strtolower($paymentId),
            $requestId,
            $timestamp
        );

        $expectedHash = hash_hmac('sha256', $payload, $secret);

        return hash_equals($expectedHash, $receivedHash);
    }
}
