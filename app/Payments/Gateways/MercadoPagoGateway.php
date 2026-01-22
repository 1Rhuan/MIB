<?php

namespace App\Payments\Gateways;

use App\DTOs\PaymentResponseDto;
use App\Payments\Builders\PixPayloadBuilder;
use App\Payments\Contracts\PaymentGateway;
use App\Payments\Exceptions\MercadoPagoApiException;
use App\Payments\Http\PaymentHttpClient;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Str;

class MercadoPagoGateway implements PaymentGateway
{
    public function __construct(
        private readonly PixPayloadBuilder $payloadBuilder,
        private readonly PaymentHttpClient $http
    ) {}

    private string $url = "https://api.mercadopago.com/";

    /**
     * @throws MercadoPagoApiException
     * @throws ConnectionException
     */
    public function createPix(array $data): PaymentResponseDto
    {
        $payload = $this->payloadBuilder->build($data);

        try {
            $response = $this->http->post(
                $this->url . '/v1/payments',
                $payload,
                [
                    'Authorization' => 'Bearer ' . config('services.mercadopago.token'),
                    'X-Idempotency-Key' => $payload['external_reference'],
                ]
            );
        } catch (\Throwable $e) {
            throw new MercadoPagoApiException(
                message: 'Falha de comunicação com o Mercado Pago',
                previous: $e
            );
        }

        if (!array_key_exists('status', $response)) {
            throw new MercadoPagoApiException(
                message: 'Resposta inválida do Mercado Pago',
            );
        }

        if (is_int($response['status'])) {
            throw new MercadoPagoApiException(
                message: $response['message'] ?? 'Erro retornado pelo Mercado Pago',
                httpStatus: $response['status'],
                causes: $response['cause'] ?? []
            );
        }

        return PaymentResponseDto::fromMercadoPago($response);
    }

    public function getStatus(array $data)
    {
        // TODO: Implement getStatus() method.
    }
}
