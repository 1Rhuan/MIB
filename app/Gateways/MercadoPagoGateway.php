<?php

namespace App\Gateways;

use App\Configs\MercadoPagoSDKConfig;
use App\Contracts\PaymentGateway;
use Exception;
use Illuminate\Support\Facades\Log;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\InvalidArgumentException;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\Resources\Payment;

class MercadoPagoGateway implements PaymentGateway
{

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(
        private readonly PaymentClient $paymentClient,
    ) {
        MercadoPagoSDKConfig::configure();
    }

    /**
     * Creates a new PIX payment using the MercadoPago API.
     * @param array $payload The payment data to be sent to the MercadoPago API.
     * @return Payment The created payment object returned by the MercadoPago API.
     * @throws MPApiException
     */
    public function create(array $payload): Payment
    {
        try {
            return $this->paymentClient->create($payload);
        } catch (MPApiException $e) {
            Log::error('Error creating PIX payment: ' . $e->getMessage(), ['api_response' => $e->getApiResponse()->getContent()]);
            throw new MPApiException('Error creating PIX payment: ', $e->getApiResponse()->getContent());
        } catch (Exception $e) {
            Log::error('Unexpected error creating PIX payment: ' . $e->getMessage());
            throw new Exception('Unexpected error creating PIX payment: ' . $e->getMessage());
        }
    }

    /**
     * @throws MPApiException
     */
    public function find(int $paymentId): Payment
    {
        try {
            return $this->paymentClient->get($paymentId);
        } catch (MPApiException $e) {
            Log::error('Error getting PIX payment: '.$e->getApiResponse());
            throw new MPApiException('Error get PIX payment: ', $e->getApiResponse());
        } catch (Exception $e) {
            Log::error('Unexpected error getting PIX payment: ' . $e->getMessage());
            throw new Exception('Unexpected error getting PIX payment: ' . $e->getMessage());
        }
    }
}
