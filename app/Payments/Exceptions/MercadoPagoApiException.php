<?php

namespace App\Payments\Exceptions;

use Exception;
use Throwable;

class MercadoPagoApiException extends Exception
{
    protected array $causes;

    public function __construct(
        string $message,
        int $httpStatus = 0,
        array $causes = [],
        ?Throwable $previous = null
    ) {
        $this->causes = $causes;

        parent::__construct($this->buildMessage($message, $causes), $httpStatus, $previous);
    }

    protected function buildMessage(string $message, array $causes): string
    {
        if (empty($causes)) {
            return $message;
        }

        $details = collect($causes)
            ->map(fn ($cause) =>
            "[{$cause['code']}] {$cause['description']}"
            )
            ->implode('; ');

        return "{$message} | Causas: {$details}";
    }

    public function getCauses(): array
    {
        return $this->causes;
    }
}
