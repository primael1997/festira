<?php

namespace Database\Factories;

use App\Models\Edition;
use App\Models\Sponsort;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Sponsort>
 */
class SponsortFactory extends Factory
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
            'name' => fake()->company(),
            'secteur' => fake()->randomElement([
                'Informatique',
                'Télécommunications',
                'Banque',
                'Assurance',
                'Agroalimentaire',
                'BTP',
                'Santé',
                'Éducation',
                'Commerce',
                'Transport',
            ]),
            'responsable' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->companyEmail(),
            'adresse' => fake()->address(),
            'message' => fake()->paragraph(3),
        ];
    }
}
