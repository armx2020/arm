<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:255'],
            'address'       => ['nullable', 'string', 'max:128'],
            'image'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove'  => ['nullable', 'in:delete'],
            'description'   => ['nullable', 'string'],
            'city'          => ['integer'],
            'date_to_start' => ['required', 'date'],
            'parent'        => []  // TODO доделать
        ];
    }
}
