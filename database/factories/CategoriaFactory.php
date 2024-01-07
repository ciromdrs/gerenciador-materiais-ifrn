<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /* TODO: Adicionar Cat `i` (como em MaterialFactory) para evitar nomes
           repetidos. */
        return [
            'nome' => fake()->word(),
        ];
    }
}
