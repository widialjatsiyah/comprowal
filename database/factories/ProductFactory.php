<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
            'title' => fake()->sentence(3),
            'category' => fake()->randomElement(['SaaS', 'Mobile App', 'Web App']),
            'summary' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'sort_order' => fake()->numberBetween(0, 10),
            'is_featured' => false,
            'is_active' => true,
        ];
    }
}
