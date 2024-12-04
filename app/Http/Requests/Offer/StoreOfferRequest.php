<?php

namespace App\Http\Requests\Offer;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'    => ['unique:company_offers', 'required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:128'],
            'image'   => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image1'  => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image2'  => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image3'  => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image4'  => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'city'          => ['integer'],
            'user'          => ['nullable', 'integer'],
            'category'    => ['required'],
        ];
    }
}
