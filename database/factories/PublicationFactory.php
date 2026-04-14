<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PublicationFactory extends Factory
{
    public function definition(): array
{
    return [
        'titre' => fake()->sentence(6),
        'contenu' => fake()->paragraphs(4, true),
        'visibilite' => 1,
        'user_id' => 1,
        'image' => null,
    ];
}
}