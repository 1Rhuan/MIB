<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class DiscordNotificationService
{
    /**
     * @throws ConnectionException
     */
    public function send(string $message): void
    {
        Http::post(
            config('services.discord.webhook_url'),
            [
                'content' => $message,
            ]
        );
    }
}
