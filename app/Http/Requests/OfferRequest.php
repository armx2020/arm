<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'name'          => ['required', 'string', 'max:40'],
            'address'       => ['max:128'],
            'phone'         => ['max:36'],
            'web'           => ['max:250'],
            'viber'         => ['max:36'],
            'whatsapp'      => ['max:36'],
            'telegram'      => ['max:36'],
            'instagram'     => ['max:36'],
            'vkontakte'     => ['max:36'],
            'image'         => ['image', 'max:2048'],
            'image1'        => ['image', 'max:2048'],
            'image2'        => ['image', 'max:2048'],
            'image3'        => ['image', 'max:2048'],
            'image4'        => ['image', 'max:2048'],
            'image_r'       => [],
            'image_r1'      => [],
            'image_r2'      => [],
            'image_r3'      => [],
            'image_r4'      => [],
            'description'   => [],
            'city'          => [],
            'unit_of_price' => [],
            'category'      => [],
            'company'       => []
        ];
    }
}
