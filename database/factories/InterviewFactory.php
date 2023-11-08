<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Interview>
 */
class InterviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = Carbon::parse(fake()->dateTimeBetween('last week', 'next week'));
        $status = $date->lt(today()) ? 'done' : 'scheduled';

        return [
            'date' => $date->format('Y-m-d'),
            'time' => fake()->dateTimeBetween('8am', '3pm')->format('H:i'),
            'note' => fake()->sentence(),
            'status' => $status,
        ];
    }
}
