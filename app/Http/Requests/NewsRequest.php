<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:255'],
            'image'         => ['image', 'max:20000'],
            'image1'        => ['image', 'max:20000'],
            'image2'        => ['image', 'max:20000'],
            'image3'        => ['image', 'max:20000'],
            'image4'        => ['image', 'max:20000'],
            'image_r'       => [],
            'image_r1'      => [],
            'image_r2'      => [],
            'image_r3'      => [],
            'image_r4'      => [],
            'description'   => [],
            'city'          => [],
            'date'          => [],
            'parent'        => []
        ];
    }
}
