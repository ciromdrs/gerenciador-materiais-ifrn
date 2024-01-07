<?php

namespace Database\Factories;

use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id = Material::max('id') + 1; // Pega o próximo id

        return [
            // Usar o id garante que não haverá materiais iguais
            'nome' => "Mat $id " . fake()->word(),
        ];
    }
}
