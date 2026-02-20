<?php

namespace App\Services;

use App\Gateways\MercadoPagoGateway;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    public function __construct(
        public MercadoPagoGateway $paymentGateway
    ) {}

    public function create(Order $order, Product $product): ?Payment
    {
        $payload = $this->buildPayload($order, $product);

        try {
            $gatewayResponse = $this->paymentGateway->create($payload);

            return Payment::create(
                [
                    'order_id' => $order->id,
                    'external_payment_id' => $gatewayResponse->id,
                    'external_reference' => $order->reference,
                    'status' => $gatewayResponse->status,
                    'status_detail' => $gatewayResponse->status_detail,
                    'transaction_amount' => $gatewayResponse->transaction_amount,
                    'fee_amount' => $gatewayResponse->taxes_amount,
                    'payment_method' => $gatewayResponse->payment_method_id,
                    'qr_code_base64' => $gatewayResponse->point_of_interaction->transaction_data->qr_code_base64,
                    'qr_code' => $gatewayResponse->point_of_interaction->transaction_data->qr_code,
                    'date_created' => Carbon::parse($gatewayResponse->date_created)->addHours(4),
                    'date_expiration' => Carbon::parse($gatewayResponse->date_of_expiration)->addHours(4),
                ]
            );
        } catch (\Throwable $e) {
            Log::error('Payment creation failed', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    private function buildPayload(Order $order, Product $product): array
    {
        return [
            'external_reference' => $order->reference,
            'payment_method_id' => 'pix',
            'transaction_amount' => (float) $order->total_amount,
            'payer' => [
                'first_name' => $order->customer->first_name,
                'last_name' => $order->customer->last_name,
                'email' => $order->customer->email,
            ],
            'notification_url' => Route('webhook.mercadopago.payments'),
            'date_of_expiration' => Carbon::now()
                ->addMinutes(30)
                ->format('Y-m-d\TH:i:s.vP'),
            'additional_info' => [
                'items' => [
                    [
                        'id' => $product->id,
                        'title' => $product->title,
                        'description' => $product->description,
                        'unit_price' => (float) $product->price,
                        'quantity' => 1,
                    ],
                ],
            ],

        ];
    }
}
