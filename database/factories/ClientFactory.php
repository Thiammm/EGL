<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pays = $this->faker->country();
        $ville = $this->faker->city();
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'dateNaissance' => $this->faker->date(),
            'lieuNaissance' => $this->faker->city(),
            'nationalite' => $this->faker->country(),
            'ville' => $ville,
            'pays' => $pays,
            'email' => $this->faker->email(),
            'adresse' => "$ville, $pays",
            'telephone1' => $this->faker->phoneNumber(),
            'telephone2' => $this->faker->phoneNumber(),
            'sexe' => array_rand(array_flip(["H", "F"]), 1),
            'pieceIdentite' => array_rand(array_flip(["CNI", "PERMIS DE CONDUIRE", "PASSPORT"]), 1),
            'noPieceIdentite' => $this->faker->creditCardNumber(),
        ];
    }
}
