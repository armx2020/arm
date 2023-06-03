<?php

namespace Database\Factories;

use App\Models\OfferCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OfferCategory>
 */
class OfferCategoryFactory extends Factory
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
            'sort_id' => rand(1, 10)
        ];
    }

    protected $model = OfferCategory::class;
}
