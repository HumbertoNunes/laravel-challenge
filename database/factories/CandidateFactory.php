<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
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
            'birthdate' => fake()->dateTimeBetween('-40 years', '-18 years'),
            'gender' => fake()->randomElement(['male', 'female']),
            'course' => fake()->randomElement(['Computer Science', 'Human Resources', 'Mechanical Engineering']),
            'biography' => fake()->text(70),
        ];
    }

    public function computerScientist(): static
    {
        return $this->state(fn (array $attributes) => [
            'course' => 'Computer Science',
        ]);
    }
}
