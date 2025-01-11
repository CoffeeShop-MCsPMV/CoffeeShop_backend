<?php

namespace Database\Factories;

use App\Models\Dictionary;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user' => User::inRandomOrder()->first()->id, 
            'date' => $this->faker->dateTimeThisYear(), 
            'total_cost' => $this->faker->randomFloat(2, 800, 5000), 
            'order_status' => $this->faker->randomElement(['Received', 'Processing', 'Ready', 'Released', 'Archive'])
        ];
    }
}
