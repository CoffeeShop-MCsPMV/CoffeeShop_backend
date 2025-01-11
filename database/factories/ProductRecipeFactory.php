<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductRecipeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product' => Product::factory(), 
            'ingredient' => Product::factory(), 
            'quantity' => $this->faker->numberBetween(1, 10),
        ];
    }
}
