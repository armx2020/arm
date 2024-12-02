<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:255'],
            'address'       => ['nullable', 'string','max:128'],
            'phone'         => ['nullable', 'string','max:36'],
            'description'   => ['nullable', 'string'],
            'web'           => ['nullable', 'string','max:250'],
            'viber'         => ['nullable', 'string','max:36'],
            'whatsapp'      => ['nullable', 'string','max:36'],
            'telegram'      => ['nullable', 'string','max:36'],
            'instagram'     => ['nullable', 'nullable','string','max:36'],
            'vkontakte'     => ['nullable', 'string','max:36'],
            'image'         => ['nullable', 'image', 'mimes:jpg,bmp,png', 'max:20000'],
            'image_remove'  => ['nullable', 'in:delete'],
            'city'          => ['integer'],
            'user'          => ['nullable', 'integer'],
            'categories'    => [], // TODO Закончить с полями у компании (категории - null?)
        ];
    }
}