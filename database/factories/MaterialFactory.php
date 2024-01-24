<?php

namespace Database\Factories;

use App\Enums\EstadoConservacaoEnum;
use App\Models\Local;
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
        $locais = Local::all();

        return [
            // Usar o id garante que não haverá materiais iguais
            'nome' => "Mat $id " . fake()->word(),
            'estado_conservacao' => fake()->randomElement(EstadoConservacaoEnum::cases()),
            'local_id' => fake()->randomElement($locais)->id,
        ];
    }
}
