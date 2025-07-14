<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Worker>
 */
class WorkerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

        'nic' => $this->faker->unique()->bothify('########?#'),
        'name' => $this->faker->name(),
        'address' => $this->faker->address(),
        'daily_rate' => $this->faker->randomFloat(2, 50, 200),
        'transportation_fee' => $this->faker->randomFloat(2, 5, 20),
        'zone' => $this->faker->randomElement(['Zone A', 'Zone B', 'Zone C']),
            //
        ];
    }
}
