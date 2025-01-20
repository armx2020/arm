<?php

namespace App\Http\Requests\Offer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'      => ['required', 'string', 'max:255'],
            'address'   => ['nullable', 'string', 'max:128'],
            'city'      => ['nullable', 'integer'],
            'user'      => ['nullable', 'integer'],
            'category'  => ['required'],
            'entity'    => ['nullable', 'integer'],
            'activity'  => ['nullable', 'in:1'],
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
