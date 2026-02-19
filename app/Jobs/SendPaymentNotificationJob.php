<?php

namespace App\Jobs;

use App\Models\Payment;
use App\Actions\SendDiscordWebhook;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendPaymentNotificationJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly int $paymentId,
    ) {}

    public function handle(): void
    {
        $payment = Payment::find($this->paymentId);

        if (! $payment) {
            return;
        }

        $payment->load([
            'order.customer',
            'order.shipping',
            'order.product',
        ]);

        $order = $payment->order;

        $customer = $order->customer;

        $product = $order->product;

        $shipping = $order->shipping->first();

        $payload = [
            'content' => 'MIB - site',
            'embeds' => [
                [
                    'title' => '🟢 Pagamento Aprovado',
                    'description' => 'Um novo pagamento foi confirmado no sistema.',
                    'color' => 0x2ECC71,
                    'fields' => [
                        [
                            'name' => '🧾 Pedido',
                            'value' => "#{$order->id}",
                            'inline' => true,
                        ],
                        [
                            'name' => '👤 Cliente',
                            'value' => $customer->first_name,
                            'inline' => true,
                        ],
                        [
                            'name' => '💰 Valor',
                            'value' => 'R$ ' . number_format($order->total_amount, 2, ',', '.'),
                            'inline' => true,
                        ],
                        [
                            'name' => '🎮 Plataforma',
                            'value' => $shipping->platform,
                            'inline' => true,
                        ],
                        [
                            'name' => '🆔 Player ID',
                            'value' => $shipping->player_id,
                            'inline' => true,
                        ],
                        [
                            'name' => '📦 Produto',
                            'value' => $product->title,
                        ],
                    ],
                    'footer' => [
                        'text' => config('app.name') . ' • Sistema de Pagamentos',
                    ],
                    'timestamp' => now()->toIso8601String(),
                ],
            ],
        ];

        app(SendDiscordWebhook::class)->execute($payload);
    }

}
