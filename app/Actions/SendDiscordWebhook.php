<?php

namespace App\Actions;

use Illuminate\Support\Facades\Http;

class SendDiscordWebhook
{
    public function execute(array $payload): void
    {
        $webhookUrl = config('services.discord.webhook_url');

        if (! $webhookUrl) {
            return;
        }

        $response = Http::timeout(5)
            ->retry(3, 200)
            ->post($webhookUrl, $payload);

        if ($response->failed()) {
            \Log::error('Discord webhook failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        }
    }
}
