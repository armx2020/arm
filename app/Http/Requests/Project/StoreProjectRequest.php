<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'              => ['required', 'string', 'max:255'],
            'address'           => ['max:128'],
            'image'             => ['image', 'max:20000'],
            'image_remove'           => [],
            'description'       => [],
            'city'              => [],
            'donations_need'    => [],
            'donations_have'    => [],
            'parent'            => []
        ];
    }
}
