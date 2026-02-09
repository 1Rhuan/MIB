<?php

namespace App\config;

use MercadoPago\Exceptions\InvalidArgumentException;
use MercadoPago\MercadoPagoConfig;

/**
 * Configures the MercadoPago SDK using settings from the configuration file.
 */
final readonly class MercadoPagoSDKConfig
{
    /**
     * Configures the MercadoPago SDK with settings from the configuration file.
     *
     * @throws \RuntimeException if the access token is not configured
     * @throws InvalidArgumentException
     */
    public static function configure(): void
    {
        $token = config('mercadopago.access_token');

        if (empty($token)) {
            throw new \RuntimeException(
                'MercadoPago access token not configured'
            );
        }

        MercadoPagoConfig::setAccessToken($token);

        MercadoPagoConfig::setRuntimeEnviroment(
            app()->isLocal()
                ? MercadoPagoConfig::LOCAL
                : MercadoPagoConfig::SERVER
        );

        MercadoPagoConfig::setConnectionTimeout(
            (int)config('mercadopago.connection_timeout')
        );

        MercadoPagoConfig::setMaxRetries(
            (int)config('mercadopago.max_retries')
        );
    }
}
