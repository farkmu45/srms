<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Submission>
 */
class SubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'case' => fake()->text(),
            'details' => fake()->text(),
            'proof' => fake()->image(),
            'type' => fake()->randomElement(['CRIMINAL', 'MEDICAL', 'ACHIEVEMENT'])
        ];
    }
}
