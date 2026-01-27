<?php

namespace App\Observers;

 use App\Enums\OrderStatus;
 use App\Enums\PaymentStatus;
 use App\Jobs\SendPaymentNotificationJob;
 use App\Models\Payment;

 class PaymentObserver
{
    public function updated(Payment $payment): void
    {

        if (! $payment->wasChanged('status')) {
            return;
        }

        if ($payment->getOriginal('status') === PaymentStatus::APPROVED) {
            return;
        }

        if ($payment->status !== PaymentStatus::APPROVED) {
            return;
        }

        $payment->order()->update([
            'status' => OrderStatus::PAID
        ]);

        SendPaymentNotificationJob::dispatch($payment->id);
    }
}
