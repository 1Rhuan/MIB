<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;

class OrderService
{
    public function create(Product $product, Customer $customer, array $destinationAccount): Order
    {
        $order = Order::create(
            [
                'reference' => Str::ulid(),
                'customer_id' => $customer->id,
                'payment_method' => 'pix',
                'product_id' => $product->id,
                'total_amount' => ($product->price - $product->discount),
            ]
        );

        $order->shipping()->create([
            'platform' => $destinationAccount['platform'],
            'player_id' => $destinationAccount['player_id'],
        ]);

        return $order;
    }
}
