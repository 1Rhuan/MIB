<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Payments\Contracts\PaymentGateway;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class CreateOrderService
{
    public function __construct
    (
        private readonly PaymentGateway $paymentGateway
    )
    {}

    public function createOrder(array $data): array
    {
        return DB::transaction(function () use ($data) {

            $product = Product::findOrFail($data['product_id']);

            if(! $product->active) {
                throw new RuntimeException('Product unavailable.');
            }

            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'steam_id' => $data['steam_id'],
                    'nickname' => $data['nickname'],
                ]
            );

            $order = Order::create([
                'reference' => Str::ulid(),
                'user_id' => $user->id,
                'status' => OrderStatus::PENDING,
                'total_amount' => 0,
            ]);

            $orderItems = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'unit_price' => $product->price,
                'quantity' => $data['quantity'],
                'total_price' => $product->price * $data['quantity'],
            ]);

            $order->load('OrderItems');

            $total = $order->orderItems->sum('total_price');

            $order->update([
                'total_amount' => $total,
            ]);

            $payment = $this->paymentGateway->createPix([
                'reference' => $order->id,
                'amount' => (float) $order->total_amount,
                'description' => $order->title,
                'email' => $user->email,
            ]);

            $paymentModel = new Payment();

            $paymentModel->forceFill(array_merge(
                $payment->toArray(),
                ['order_id' => $order->id],
            ));

            $paymentModel->save();

            return [
                'order' => $order,
                "qr_code" => $payment->qrCode,
                "qr_code_base64" => $payment->qrCodeBase64,
                "qr_code_url" => $payment->ticketUrl,
            ];
        });
    }
}
