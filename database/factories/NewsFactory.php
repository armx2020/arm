<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
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
            'description' => Str::random(20),
            'time' => now(),
            'image' => 'https://jjji.ru/200x200',
            'image1' => 'https://jjji.ru/200x200',
            'image2' => 'https://jjji.ru/200x200',
            'image3' => 'https://jjji.ru/200x200',
            'image4' => 'https://jjji.ru/200x200',
        ];
    }
}
