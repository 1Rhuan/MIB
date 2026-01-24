<?php

namespace App\Jobs;

use App\Enums\PaymentStatus;
use App\Models\Payment;
use App\Payments\Contracts\PaymentGateway;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdatePaymentStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly int $gatewayId,
    ){}

    /**
     * @param PaymentGateway $gateway
     * @return void
     */
    public function handle(PaymentGateway $gateway): void
    {
        $payment = Payment::where('gateway_payment_id', $this->gatewayId)->first();

        if (!$payment) {
            return;
        }

        $gatewayPayment = $gateway->getPayment(
            $payment->gateway_payment_id,
        );

        $data = [
            'status' => $gatewayPayment->status,
            'status_detail' => $gatewayPayment->statusDetail,
        ];

        if ($gatewayPayment->status == PaymentStatus::APPROVED) {
            $data['date_approved'] = $gatewayPayment->dateApproved;
        }

        $payment->update($data);
    }
}
