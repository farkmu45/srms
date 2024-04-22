<?php

namespace Database\Factories;

use App\Models\Mentor;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'parent_name' => fake()->name(),
            'date_of_birth' => fake()->date(),
            'phone_number' => fake()->e164PhoneNumber(),
            'parent_phone_number' => fake()->e164PhoneNumber(),
            'country_id' => 4,
            'mentor_id' => Mentor::factory(),
        ];
    }
}
