<?php

namespace Database\Factories;

use App\Models\Material;
use App\Models\Local;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Pega o id de todos os materiais
        $materiais = array_map(
            function($material) {
                return $material['id'];
            },
            Material::all()->toArray()
        );
        
        // Pega o id de todos os locais
        $locais = array_map(
            function($local) {
                return $local['id'];
            },
            Local::all()->toArray()
        );

        return [
            'estado_conservacao' => fake()->randomElement(['Utilizável', 'Em manutenção', 'Inutilizável']),
            'local_id' => fake()->randomElement($locais),
            'material_id' => fake()->randomElement($materiais),
            'foto'=> '/upload/fotos/' . fake()->bothify('/######.????##-#?.jpg'),
        ];
    }
}
