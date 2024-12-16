<?php

namespace App\Http\Requests\Group;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:255'],
            'address'       => ['nullable', 'string', 'max:128'],
            'phone'         => ['nullable', 'string', 'max:36', 'unique:groups'],
            'description'   => ['nullable', 'string'],
            'web'           => ['nullable', 'string', 'max:250'],
            'viber'         => ['nullable', 'string', 'max:36'],
            'whatsapp'      => ['nullable', 'string', 'max:36'],
            'telegram'      => ['nullable', 'string', 'max:36'],
            'instagram'     => ['nullable', 'string', 'max:36'],
            'vkontakte'     => ['nullable', 'string', 'max:36'],
            'image'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image1'        => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image2'        => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image3'        => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image4'        => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove'       => ['nullable', 'in:delete'],
            'image_remove1'      => ['nullable', 'in:delete'],
            'image_remove2'      => ['nullable', 'in:delete'],
            'image_remove3'      => ['nullable', 'in:delete'],
            'image_remove4'      => ['nullable', 'in:delete'],
            'city'          => ['integer'],
            'user'          => ['nullable', 'integer'],
            'category'    => ['required'],
        ];
    }
}
