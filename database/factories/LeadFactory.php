<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
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
            'phone' => fake()->phoneNumber(),
            'date' => fake()->dateTime(),
            'hotel_id' => Hotel::factory(),
            'email' => fake()->email(),
            'nr_room' => fake()->numberBetween(1, 10),
            'question' => fake()->randomElement(['1 vez ao ano', '2 vezes ao ano', '3 vezes ou mais ao ano', 'É a minha primeira vez']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
