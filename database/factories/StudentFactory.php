<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Webpatser\Countries\Countries;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
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
            'matrix' => fake()->unique()->numberBetween(100000000000, 999999999999),
            'semester' => fake()->numberBetween(1, 8),
            'country_id' => 4,
        ];
    }
}
