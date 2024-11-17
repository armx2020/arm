<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => Str::random(10),
            'address' => Str::random(20),
            'description' => Str::random(20),
            'phone' => Str::random(11),
            'city_id' => rand(307, 312),
            'region_id' => 66,
            'web' => Str::random(36),
            'viber' => Str::random(36),
            'whatsapp' => Str::random(36),
            'instagram' => Str::random(36),
            'vkontakte'=> Str::random(36),
            'telegram' => Str::random(36),
            'category_id' => rand(1, 10)
        ];
    }
}
