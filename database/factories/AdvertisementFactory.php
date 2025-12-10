<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertisementFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'content' => fake()->paragraphs(3, true),
            'price' => fake()->numberBetween(10, 10000),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'category_id' => Category::factory(),
        ];
    }
}
