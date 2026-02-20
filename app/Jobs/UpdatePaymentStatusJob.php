<?php

namespace App\Jobs;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Gateways\MercadoPagoGateway;
use App\Models\Payment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdatePaymentStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly int $gatewayPaymentId,
    ) {}

    public function handle(MercadoPagoGateway $gateway): void
    {
        $payment = Payment::where('external_payment_id', $this->gatewayPaymentId)->first();

        if (! $payment) {
            return;
        }

        $gatewayResponse = $gateway->find(
            $payment->external_payment_id,
        );

        if ($payment->status === $gatewayResponse->status) {
            return;
        }

        $data = [
            'status' => $gatewayResponse->status,
            'status_detail' => $gatewayResponse->status_detail,
        ];

        if ($gatewayResponse->status === PaymentStatus::APPROVED->value) {
            $data['date_approved'] = $gatewayResponse->date_approved;

            $payment->order()->update([
                'status' => OrderStatus::PAID,
            ]);
        }

        if ($gatewayResponse->status === PaymentStatus::EXPIRED->value) {
            $payment->order()->update([
                'status' => OrderStatus::CANCELLED,
            ]);
        }

        if ($gatewayResponse->status === PaymentStatus::CANCELLED->value) {
            $payment->order()->update([
                'status' => OrderStatus::CANCELLED,
            ]);
        }

        $payment->update($data);
    }
}
