<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cup_id' => OrderItem::factory(), 
            'product_id' => Product::factory(),
            'product_type' => $this->faker->randomElement(['I', 'F','E']),
        ];
    }
}
