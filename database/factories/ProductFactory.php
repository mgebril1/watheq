<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'slug' => fake()->unique()->name(),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 10, 1000),
            'is_active' => fake()->boolean(),
        ];
    }
}
