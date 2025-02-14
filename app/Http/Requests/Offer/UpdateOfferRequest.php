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
            'images'           => ['nullable', 'array', 'max:20'],
            'images.*.id'      => ['required'],
            'images.*.sort_id' => ['required', 'integer'],
            'images.*.file'    => ['nullable', 'file', 'mimes:jpg,jpeg,png|max:2048'],
        ];
    }
}
