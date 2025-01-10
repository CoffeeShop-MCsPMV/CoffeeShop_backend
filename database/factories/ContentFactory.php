<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cup_id' => OrderItem::factory(), // Véletlenszerű order_item generálása
            'product_id' => Product::factory(), // Véletlenszerű product generálása
            'product_type' => $this->faker->randomElement(['I', 'F','E']),
        ];
    }
}
