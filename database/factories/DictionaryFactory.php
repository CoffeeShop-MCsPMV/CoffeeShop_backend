<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DictionaryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->lexify('???'),
            'description' => $this->faker->word,
            'reference' => $this->faker->randomElement(['A', 'B', 'C'])
        ];
    }
}
