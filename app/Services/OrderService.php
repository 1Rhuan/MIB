<?php

namespace App\Services;

use App\DTOs\CreateOrderDto;
use App\DTOs\PaymentRequestDto;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Payments\Contracts\PaymentGateway;
use Illuminate\Support\Facades\Log;

class OrderService
{
    public function __construct
    (
        private readonly PaymentGateway $paymentGateway
    )
    {}

    public function createOrder(CreateOrderDto $orderDto): array
    {

        $product = Product::findOrFail($orderDto->product_id);

        $customer = Customer::firstOrCreate(
            ['email' => $orderDto->email],
            [
                'first_name' => $orderDto->first_name,
                'last_name' => $orderDto->last_name,
            ]
        );

        $order = Order::create([
            'customer_id' => $customer->id,
            'total_amount' => 0,
        ]);

        $order->orderItems()->create(
            [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'unit_price' => $product->price,
                'quantity' => 1,
                'total_price' => $product->price,
            ]
        );

        $order->update([
            'total_amount' => $product->price,
        ]);

        $order->orderTarget()->create([
            'platform' => $orderDto->platform,
            'player_id' => $orderDto->player_id,
            'nickname' => $orderDto->nickname,
        ]);


        $payment = $this->paymentGateway->createPix(new PaymentRequestDto(
            firstName: $customer->first_name,
            lastName: $customer->last_name,
            email: $orderDto->email,
            amount: (float) $order->total_amount,
            orderReference: $order->reference,
            productId: $product->id,
            productName: $product->name,
            productDescription: $product->description,
            productPrice: (float) $product->price,
            productQuantity: 1,
            productCategory: $product->category,
        ));

        Log::alert("MP", $payment->toArray());

        $order->payments()->create(
            $payment->toArray(),
        );

        return [
            'order' => $order,
            "qr_code" => $payment->qrCode,
            "qr_code_base64" => $payment->qrCodeBase64,
            "mp_qr_code_link" => $payment->ticketUrl,
        ];
    }
}
