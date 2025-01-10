<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductRecipe>
 */
class ProductRecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product' => Product::factory(), 
            'ingredient' => Product::factory(), 
            'quantity' => $this->faker->numberBetween(1, 10),
        ];
    }
}
