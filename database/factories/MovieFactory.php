<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image_url' => fake()->imageUrl(),
            'title' => fake()->name(),
            'slug' => fake()->slug(),
            'genre_id' => fake()->numberBetween(1, 18),
            'release_date' => fake()->date(),
        ];
    }
}
