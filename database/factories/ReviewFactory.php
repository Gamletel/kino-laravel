<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'film_id'=>1,
            'user_id'=>1,
            'title'=>fake()->text(50),
            'text'=>fake()->text,
            'stars'=>fake()->numberBetween(0, 5),
        ];
    }
}
