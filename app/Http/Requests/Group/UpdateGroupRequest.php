<?php

namespace App\Http\Requests\Group;

use App\Rules\InstagramUrl;
use App\Rules\TelegramUrl;
use App\Rules\VkontakteUrl;
use App\Rules\WebUrl;
use App\Rules\WhatsappUrl;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupRequest extends FormRequest
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
            'image'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove'  => ['nullable', 'in:delete'],
            'city'          => ['integer'],
            'user'          => ['nullable', 'integer'],
            'category'      => ['required'],
        ];
    }
}
