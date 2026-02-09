<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mercado Pago Access Token
    |--------------------------------------------------------------------------
    |
    | Access Token para autenticação na API do Mercado Pago.
    | Obtenha em: https://www.mercadopago.com.br/developers/panel/credentials
    |
    */
    'access_token' => env('MERCADOPAGO_ACCESS_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | Mercado Pago Public Key
    |--------------------------------------------------------------------------
    |
    | Public Key usada no frontend para tokenização de cartões.
    |
    */
    'public_key' => env('MERCADOPAGO_PUBLIC_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Timeout de Requisições
    |--------------------------------------------------------------------------
    |
    | Tempo máximo de espera para requisições (em segundos).
    |
    */
    'connection_timeout' => env('MERCADOPAGO_CONNECTION_TIMEOUT', 30),

    /*
    |--------------------------------------------------------------------------
    | Número Máximo de Tentativas
    |--------------------------------------------------------------------------
    |
    | Número de tentativas em caso de falha temporária.
    |
    */
    'max_retries' => env('MERCADOPAGO_MAX_RETRIES', 2),


    /*
    |--------------------------------------------------------------------------
    | URLs de Callback
    |--------------------------------------------------------------------------
    |
    | URLs para notificações de webhook e retorno.
    |
    */
    'webhook_url' => env('MERCADOPAGO_WEBHOOK_URL', '/api/webhooks/payments/mercadopago'),
    'success_url' => env('MERCADOPAGO_SUCCESS_URL', '/pagamento/sucesso'),
    'failure_url' => env('MERCADOPAGO_FAILURE_URL', '/pagamento/falha'),
    'pending_url' => env('MERCADOPAGO_PENDING_URL', '/pagamento/pendente'),
];
