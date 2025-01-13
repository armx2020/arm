<?php

namespace App\Rules;

use App\Services\ParseUrlService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TelegramUrl implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $url = ParseUrlService::parse_url_if_valid($value);

        $parse = parse_url($url);

        if ($parse["host"] !== 't.me') {
            $fail('Неверный формат :attribute');
        }

        if (!array_key_exists("path", $parse)) {
            $fail('Добавьте в :attribute свой идентификатор');
        }
    }
}
