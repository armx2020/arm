<?php

namespace App\Http\Requests\Group;

use App\Rules\InstagramUrl;
use App\Rules\TelegramUrl;
use App\Rules\VkontakteUrl;
use App\Rules\WebUrl;
use App\Rules\WhatsappUrl;
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
            'whatsapp'      => ['nullable', new WhatsappUrl],
            'telegram'      => ['nullable', new TelegramUrl],
            'instagram'     => ['nullable', new InstagramUrl],
            'vkontakte'     => ['nullable', new VkontakteUrl],
            'city'          => ['integer'],
            'user'          => ['nullable', 'integer'],
            'category'      => ['required'],
            'image'           => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove'    => ['nullable', 'in:delete'],
            'image_1'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_1'  => ['nullable', 'in:delete'],
            'image_2'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_2'  => ['nullable', 'in:delete'],
            'image_3'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_3'  => ['nullable', 'in:delete'],
            'image_4'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_4'  => ['nullable', 'in:delete'],

        ];
    }
}
