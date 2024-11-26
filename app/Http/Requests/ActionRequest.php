<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'      => ['required', 'string', 'max:255'],
            'description'   => [],
            'price'   => [],
        ];
    }
}
