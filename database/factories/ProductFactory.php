<?php

namespace Database\Factories;

use App\Models\Dictionary;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'type' => $this->faker->randomElement(['I', 'F',]),
            'category' => Dictionary::inRandomOrder()->value('id') ?? 'DEF',
            'is_available' => $this->faker->boolean(80),
            'current_price' => $this->faker->randomFloat(2, 1, 100),
            'unit_ml' => $this->faker->numberBetween(100, 1000),
        ];
    }
}
