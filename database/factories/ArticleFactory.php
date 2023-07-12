<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->name(),
            'noSerie' => $this->faker->creditCardNumber(),
            'estDisponible' => rand(0, 1),
            'imgUrl' => "",
            'type_article_id' => rand(1, 4),
        ];
    }
}
