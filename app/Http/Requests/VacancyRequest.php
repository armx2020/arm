<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacancyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:255'],
            'address'       => ['max:128'],
            'image'         => ['image', 'max:20000'],
            'image_remove'       => [],
            'description'   => [],
            'city'          => [],
            'parent'        => []
        ];
    }
}
