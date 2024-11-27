<?php

namespace Database\Factories;

use App\Enums\EmployeeStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date_of_birth' => fake()->date(),
            'city' => fake()->randomElement([
                'Jogja',
                'Bantul',
                'Sleman',
                'Gunung Kidul',
            ]),
            'status' => fake()->randomElement(EmployeeStatus::cases()),
        ];
    }
}
