<?php

namespace App\Http\Requests\Group;

use App\Rules\InstagramUrl;
use App\Rules\TelegramUrl;
use App\Rules\VkontakteUrl;
use App\Rules\WebUrl;
use App\Rules\WhatsappUrl;
use App\Rules\YoutubeUrl;
use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:255', 'min:3'],
            'address'       => ['nullable', 'string', 'max:128'],
            'phone'         => ['nullable', 'string', 'max:36'],
            'description'   => ['nullable', 'string'],
            'web'           => ['nullable', new WebUrl],
            'video_url'     => ['nullable', new YoutubeUrl],
            'whatsapp'      => ['nullable', new WhatsappUrl],
            'telegram'      => ['nullable', new TelegramUrl],
            'instagram'     => ['nullable', new InstagramUrl],
            'vkontakte'     => ['nullable', new VkontakteUrl],
            'city'          => ['integer'],
            'user'          => ['nullable', 'integer'],
            'category'      => ['required'],
            'images'        => ['nullable', 'array', 'max:20'],
            'images.*'      => ['image', 'mimes:jpg,bmp,png', 'max:20480'],

        ];
    }
}
