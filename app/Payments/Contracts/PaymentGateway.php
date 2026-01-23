<?php

namespace App\Payments\Contracts;

use App\Payments\DTOs\PaymentResponseDto;

/**
 * @returns PaymentResponseDto
 */
interface PaymentGateway
{
    public function createPix(array $data): PaymentResponseDto;
    public function getPayment(string $paymentId): PaymentResponseDto;
}
