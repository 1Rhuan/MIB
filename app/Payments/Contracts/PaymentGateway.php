<?php

namespace App\Payments\Contracts;


use App\DTOs\PaymentRequestDto;
use App\DTOs\PaymentResponseDto;

/**
 * * Interface PaymentGateway
 * @package App\Payments\Contracts
 * * @param PaymentRequestDto $data
 * @returns PaymentResponseDto
 */
interface PaymentGateway
{
    public function createPix(PaymentRequestDto $paymentRequestDto): PaymentResponseDto;
    public function getPayment(string $paymentId): PaymentResponseDto;
}
