<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Carbon;

class CheckoutService
{
    public function __construct(
        public OrderService $orderService,
        public PaymentService $paymentService,
    )
    {
        //
    }

    public function process(Product $product, array $data): string
    {
        $customer = Customer::firstOrCreate(
            ['email' => $data['email']],
            [
                'first_name' => explode(' ', $data['name'])[0],
                'last_name' => explode(' ', $data['name'])[count(explode(' ', $data['name'])) - 1],
            ],
        );

        $order = $this->orderService->create($product, $customer, $data);

        $this->paymentService->create($order, $product);

        return $order->reference;
    }
}
