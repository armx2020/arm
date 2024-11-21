<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstname'    => ['required', 'string', 'max:32'],
            'email'        => ['required', 'string', 'email', 'max:255', 'unique:App\Models\User'],
            'password'     => ['required', 'confirmed', Rules\Password::defaults()],
            'viber'        => ['max:36'],
            'whatsapp'     => ['max:36'],
            'telegram'     => ['max:36'],
            'instagram'    => ['max:36'],
            'vkontakte'    => ['max:36'],
            'image'        => ['image', 'max:20000'],
            'image_r'      => []
        ];
    }
}
