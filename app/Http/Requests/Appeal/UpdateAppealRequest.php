<?php

namespace App\Http\Requests\Appeal;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppealRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'           => ['nullable', 'string', 'max:32'],
            'phone'          => ['nullable', 'string', 'max:36'],
            'message'        => ['string'],
        ];
    }
}
