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
            'city'    => ['nullable', 'integer'],
            'user'    => ['nullable', 'integer'],
            'category'  => ['required'],
            'entity'  => ['nullable', 'integer'],
        ];
    }
}
