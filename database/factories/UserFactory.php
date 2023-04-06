<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'sexe' => array_rand(["H", "F"], 1),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'pieceIdentite' => array_rand(["CNI", "PERMIS DE CONDUIRE", "PASSPORT"], 1),
            'noPieceIdentite' => $this->faker->swiftBicNumber(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'telephone1' => $this->faker->phoneNumber(),
            'telephone2' => $this->faker->phoneNumber(),
            'imgUrl' => $this->faker->imageUrl(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
