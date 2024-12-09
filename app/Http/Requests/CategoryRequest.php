<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'      => ['required', 'string', 'max:255'],
            'sort_id'   => ['required'],
            'type'      => [],
            'image'     => ['image', 'max:20000'],
            'image_remove'   => [],
        ];
    }
}
