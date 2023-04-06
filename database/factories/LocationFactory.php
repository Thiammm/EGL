<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dateDebut' => $this->faker->date(),
            'dateFin' => $this->faker->date(),
            'statut_location_id' => rand(1, 3),
            'user_id' => rand(1, 10),
            'client_id' => rand(1, 10),
        ];
    }
}
