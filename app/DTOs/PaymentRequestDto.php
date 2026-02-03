<?php

namespace App\DTOs;

class PaymentRequestDto
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public float $amount,
        public string $orderReference,
        public string $productId,
        public string $productName,
        public string $productDescription,
        public string $productPrice,
        public string $productQuantity,
        public string $productCategory,
    )
    {}

    public static function toMercadoPago(array $data): self
    {
        return new self(
            firstName: $data['first_name'],
            lastName: $data['last_name'],
            email: $data['email'],
            amount: $data['amount'],
            orderReference: $data['order_reference'],
            productId: $data['product_id'],
            productName: $data['product_name'],
            productDescription: $data['product_description'],
            productPrice: $data['product_price'],
            productQuantity: $data['product_quantity'],
            productCategory: $data['product_category']
        );
    }
}
