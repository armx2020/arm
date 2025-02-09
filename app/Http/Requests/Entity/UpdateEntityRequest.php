<?php

namespace App\Http\Requests\Entity;

use App\Rules\InstagramUrl;
use App\Rules\TelegramUrl;
use App\Rules\VkontakteUrl;
use App\Rules\WebUrl;
use App\Rules\WhatsappUrl;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEntityRequest extends FormRequest
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
            'type'          => ['required', 'integer'],
            'category'      => ['nullable'],
            'fields'        => ['nullable'],
            'activity'      => ['nullable', 'in:1'],
            'sort_id'        => ['required'],
            'image_1'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_1'  => ['nullable', 'in:delete'],
            'activity_img_1'        => ['nullable', 'in:1'],
            'image_2'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_2'  => ['nullable', 'in:delete'],
            'activity_img_2'        => ['nullable', 'in:1'],
            'image_3'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_3'  => ['nullable', 'in:delete'],
            'activity_img_3'        => ['nullable', 'in:1'],
            'image_4'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_4'  => ['nullable', 'in:delete'],
            'activity_img_4'        => ['nullable', 'in:1'],
            'image_5'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_5'  => ['nullable', 'in:delete'],
            'activity_img_5'        => ['nullable', 'in:1'],
            'image_6'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_6'  => ['nullable', 'in:delete'],
            'activity_img_6'        => ['nullable', 'in:1'],
            'image_7'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_7'  => ['nullable', 'in:delete'],
            'activity_img_7'        => ['nullable', 'in:1'],
            'image_8'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_8'  => ['nullable', 'in:delete'],
            'activity_img_8'        => ['nullable', 'in:1'],
            'image_9'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_9'  => ['nullable', 'in:delete'],
            'activity_img_9'        => ['nullable', 'in:1'],
            'image_10'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_10'  => ['nullable', 'in:delete'],
            'activity_img_10'        => ['nullable', 'in:1'],
            'image_11'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_11'  => ['nullable', 'in:delete'],
            'activity_img_11'        => ['nullable', 'in:1'],
            'image_12'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_12'  => ['nullable', 'in:delete'],
            'activity_img_12'        => ['nullable', 'in:1'],
            'image_13'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_13'  => ['nullable', 'in:delete'],
            'activity_img_13'        => ['nullable', 'in:1'],
            'image_14'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_14'  => ['nullable', 'in:delete'],
            'activity_img_14'        => ['nullable', 'in:1'],
            'image_15'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_15'  => ['nullable', 'in:delete'],
            'activity_img_15'        => ['nullable', 'in:1'],
            'image_16'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_16'  => ['nullable', 'in:delete'],
            'activity_img_16'        => ['nullable', 'in:1'],
            'image_17'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_17'  => ['nullable', 'in:delete'],
            'activity_img_17'        => ['nullable', 'in:1'],
            'image_18'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_18'  => ['nullable', 'in:delete'],
            'activity_img_18'        => ['nullable', 'in:1'],
            'image_19'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_19'  => ['nullable', 'in:delete'],
            'activity_img_19'        => ['nullable', 'in:1'],
            'image_20'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove_20'  => ['nullable', 'in:delete'],
            'activity_img_20'        => ['nullable', 'in:1'],
        ];
    }
}
