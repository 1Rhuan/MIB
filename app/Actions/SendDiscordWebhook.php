<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SendDiscordWebhook
{
    public function execute(array $payload): void
    {
        $webhookUrl = config('services.discord.webhook_url');

        if (! $webhookUrl) {
            return;
        }

        Http::post($webhookUrl, $payload);
    }
}
