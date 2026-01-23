<?php

namespace App\Payments\Http;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class PaymentHttpClient
{
    /**
     * @throws ConnectionException
     */
    public function post(string $url, array $payload, array $headers = []): array
    {
        try {
            return Http::withHeaders($headers)
                ->post($url, $payload)
                ->json();
        } catch (ConnectionException $e) {
            logger()->error($e->getMessage());
            throw new ConnectionException($e->getMessage());
        }
    }

    /**
     * @throws ConnectionException
     */
    public function get(string $url, array $headers = []): array
    {
        try {
            return Http::withHeaders($headers)
                ->get($url)
                ->json();
        } catch (ConnectionException $e) {
            logger()->error($e->getMessage());
            throw new ConnectionException($e->getMessage());
        }
    }
}
