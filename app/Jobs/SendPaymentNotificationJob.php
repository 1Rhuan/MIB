<?php

namespace App\Jobs;

use App\Models\Payment;
use App\Services\DiscordNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendPaymentNotificationJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly int $paymentId,
    ) {}

    public function handle(DiscordNotificationService $discord): void
    {
        $payment = Payment::find($this->paymentId);

        if (! $payment) {
            return;
        }

        $message = <<<MSG
💰 **Pagamento aprovado!**
🆔 ID: {$payment->gateway_payment_id}
💵 Valor: R$ {$payment->transaction_amount}
⏰ Data: {$payment->date_approved?->format('d/m/Y H:i')}
MSG;

        $discord->send($message);
    }
}
