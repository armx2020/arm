<?php

namespace App\Http\Requests\Offer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:128'],
            'image'   => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image1'  => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image2'  => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image3'  => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image4'  => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove'   => ['nullable', 'in:delete'],
            'image_remove1'   => ['nullable', 'in:delete'],
            'image_remove2'   => ['nullable', 'in:delete'],
            'image_remove3'   => ['nullable', 'in:delete'],
            'image_remove4'   => ['nullable', 'in:delete'],
            'city'          => ['integer'],
            'user'          => ['nullable', 'integer'],
            'category'    => ['required'],
        ];
    }
}
