<?php

namespace App\Payments\Builders;
class PixPayloadBuilder
{
    public function build(array $data): array
    {
        return [
            'external_reference' => $data['reference'],
            'transaction_amount' => $data['amount'],
            'description'        => $data['description'],
            'payment_method_id'  => 'pix',
            'payer' => [
                'email' => $data['email']
            ],
            "date_of_expiration" => now('America/Sao_Paulo')
                ->addMinutes(30)
                ->format('Y-m-d\TH:i:s.vP'),
            'notification_url' => route('webhooks.payments')
        ];
    }
}
