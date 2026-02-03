<?php

namespace App\Payments\Gateways;

use App\DTOs\PaymentRequestDto;
use App\DTOs\PaymentResponseDto;
use App\Payments\Builders\PixPayloadBuilder;
use App\Payments\Contracts\PaymentGateway;
use App\Payments\Exceptions\MercadoPagoApiException;
use App\Payments\Http\PaymentHttpClient;

class MercadoPagoGateway implements PaymentGateway
{
    public function __construct(
        private readonly PixPayloadBuilder $payloadBuilder,
        private readonly PaymentHttpClient $http
    )
    {}

    private string $url = "https://api.mercadopago.com";

    /**
     * @param PaymentRequestDto $paymentRequestDto
     * @return PaymentResponseDto
     * @throws MercadoPagoApiException
     */
    public function createPix(PaymentRequestDto $paymentRequestDto): PaymentResponseDto
    {
        $payload = $this->payloadBuilder->build($paymentRequestDto);

        try {
            $response = $this->http->post(
                $this->url . '/v1/payments',
                $payload,
                [
                    'Authorization' => 'Bearer ' . config('services.mercadopago.access_token'),
                    'X-Idempotency-Key' => $paymentRequestDto->orderReference,
                ]
            );
        } catch (\Throwable $e) {
            throw new MercadoPagoApiException(
                message: 'Falha de comunicação com o Mercado Pago',
                previous: $e
            );
        }

        return $this->validateResponseApi($response);
    }

    /**
     * @param string $paymentId
     * @return PaymentResponseDto
     * @throws MercadoPagoApiException
     */
    public function getPayment(string $paymentId): PaymentResponseDto
    {
        try {
            $response = $this->http->get(
                $this->url . '/v1/payments/' . $paymentId,
                [
                    'Authorization' => 'Bearer ' . config('services.mercadopago.access_token')
                ]
            );

        } catch (\Throwable $e) {
            throw new MercadoPagoApiException(
                message: 'Falha de comunicação com o Mercado Pago',
                previous: $e
            );
        }

        return $this->validateResponseApi($response);
    }

    /**
     * @param array $response
     * @return PaymentResponseDto
     * @throws MercadoPagoApiException
     */
    private function validateResponseApi(array $response): PaymentResponseDto
    {
        if (isset($response['error'])) {
            throw new MercadoPagoApiException(
                message: $response['message'] ?? 'Erro Mercado Pago',
                httpStatus: $response['status'] ?? 500,
                causes: $response['cause'] ?? []
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
}
