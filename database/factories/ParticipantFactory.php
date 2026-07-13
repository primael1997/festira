<?php

namespace Database\Factories;

use App\Models\Edition;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Participant>
 */
class ParticipantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'edition_id' => Edition::inRandomOrder()->first()->id,
            'name' => fake()->name(),
            'sexe' => fake()->randomElement(['Masculin', 'Feminin']),
            'email' => fake()->unique()->safeEmail(),
            'ville' => fake()->city(),
            'adresse' => fake()->address(),
        ];
    }
}
