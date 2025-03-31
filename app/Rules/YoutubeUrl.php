<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class YoutubeUrl implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value === null) {
            return;
        }

        $isIframe = preg_match('/<iframe.*src="https?:\/\/www\.youtube\.com\/embed\/[^"]+".*<\/iframe>/i', $value);

        $isUrl = (bool) preg_match('/^(https?:\/\/)?(www\.)?youtube\.com\/watch\?v=[^&]+|youtube\.com\/[^" ]+/i', $value);

        if (!$isIframe && !$isUrl) {
            $fail('Поле :attribute должно содержать либо ссылку на YouTube, либо iframe-код встраивания.');
        }
    }

    public static function normalize(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim($value);

        if ($value === '') {
            return null;
        }
        if (preg_match('/<iframe.*src="(https?:\/\/www\.youtube\.com\/embed\/[^"]+)".*<\/iframe>/i', $value, $matches)) {
            return self::generateIframe($matches[1]);
        }

        if (preg_match('/youtube\.com\/watch\?v=([^&]+)/i', $value, $matches)) {
            return self::generateIframe("https://www.youtube.com/embed/{$matches[1]}");
        }

        if (preg_match('/youtube\.com\/([^" ]+)/i', $value, $matches)) {
            if (strpos($matches[1], 'embed/') === 0) {
                return self::generateIframe("https://www.youtube.com/{$matches[1]}");
            }
            return self::generateIframe("https://www.youtube.com/embed/{$matches[1]}");
        }

        return $value;
    }

    protected static function generateIframe($src)
    {
        $src = str_replace(['http://', 'https://'], '', $src);
        $src = 'https://www.' . ltrim($src, 'www.');

        return '<iframe width="400" height="400" src="' . $src . '" frameborder="0" allowfullscreen></iframe>';
    }
}
