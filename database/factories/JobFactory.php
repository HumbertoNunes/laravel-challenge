<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(30),
            'description' => fake()->text(70),
            'compensation' => fake()->randomFloat(2, 2500, 3500),
            'requirement' => fake()->randomElement(['Computer Science', 'Human Resources', 'Mechanical Engineering'])
        ];
    }
}
