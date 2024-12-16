<?php

namespace App\Http\Requests\Appeal;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppealRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'           => ['required', 'string', 'max:32'],
            'phone'          => ['nullable', 'string', 'max:36'],
            'description'    => ['nullable', 'string'],
        ];
    }
}
