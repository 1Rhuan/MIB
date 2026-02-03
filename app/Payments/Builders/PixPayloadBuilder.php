<?php

namespace App\Payments\Builders;
use App\DTOs\PaymentRequestDto;

class PixPayloadBuilder
{
    public function build(PaymentRequestDto $paymentDto): array
    {
        return [
            "external_reference" => $paymentDto->orderReference,
            "transaction_amount" => $paymentDto->amount,
            "description"        => $paymentDto->productName,
            "statement_descriptor" => config('app.name'),
            'payment_method_id'  => "pix",
            "payer" => [
                "email" => $paymentDto->email,
            ],
            "date_of_expiration" => now("America/Sao_Paulo")
                ->addMinutes(30)
                ->format("Y-m-d\TH:i:s.vP"),
            "notification_url" => "https://php.rhuan.cc/api/webhooks/payments",
            "additional_info" => [
                "items" => [
                    [
                        "id" => $paymentDto->productId,
                        "title" => $paymentDto->productName,
                        "description" => $paymentDto->productDescription,
                        "category_id" => $paymentDto->productCategory,
                        "quantity" => $paymentDto->productQuantity,
                        "unit_price" => $paymentDto->amount,
                    ],
                ],
            ],
        ];
    }
}
