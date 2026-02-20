<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FullNameRule implements ValidationRule
{
    /**
     * Indicates whether the rule should be implicit.
     *
     * @var bool
     */
    public $implicit = false;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = trim($value);

        if (! preg_match('/^[\pL\s]+$/u', $value)) {
            $fail('O nome deve conter apenas letras.');

            return;
        }

        $parts = array_filter(explode(' ', $value));

        if (count($parts) < 2) {
            $fail('Informe nome e sobrenome.');

            return;
        }

        foreach ($parts as $part) {
            if (mb_strlen($part) < 2) {
                $fail('Cada parte do nome deve ter pelo menos 2 letras.');

                return;
            }
        }
    }
}
