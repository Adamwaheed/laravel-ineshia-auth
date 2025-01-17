<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vacancy>
 */
class VacancyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'details' => $this->faker->paragraph,
            'salary' => $this->faker->numberBetween(1000, 9000),
            'status' => $this->faker->randomElement(['open', 'closed'])
        ];
    }
}
