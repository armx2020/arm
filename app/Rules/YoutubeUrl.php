<?php

namespace App\Rules;

use App\Services\ParseUrlService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class YoutubeUrl implements ValidationRule
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

        if ($parse["host"] !== 'youtube.com') {
            $fail('Неверный формат :attribute');
        }
    }
}
