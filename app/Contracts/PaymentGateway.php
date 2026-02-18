<?php

namespace App\Contracts;

use MercadoPago\Resources\Payment;

/**
 * * Interface PaymentGateway
 *
 * * @param array $data
 *
 * @returns Payment
 */
interface PaymentGateway
{
    /**
     * Create a payment via PIX.
     *
     * @param  array  $payload  payment data to be sent to the gateway.
     * @return Payment response from the gateway with created payment data.
     */
    public function create(array $payload): Payment;

    /**
     * Find a payment by its ID.
     *
     * @param  int  $paymentId  payment ID in the gateway.
     * @return Payment response from the gateway with updated payment data.
     */
    public function find(int $paymentId): Payment;
}
