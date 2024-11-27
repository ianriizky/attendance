<?php

namespace Database\Factories;

use App\Enums\PresenceType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presence>
 */
class PresenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'time' => fake()->dateTime(),
            'type' => fake()->randomElement(PresenceType::cases()),
        ];
    }
}
