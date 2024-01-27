<?php

namespace Database\Factories;

use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Emprestimo>
 */
class EmprestimoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            # TODO: Usar ids de usuários quando o cadastro estiver implementado
            'usuario_que_emprestou' => fake()->numerify('##########'),
            'usuario_que_recebeu' => fake()->numerify('##########'),
            'usuario_que_devolveu' => fake()->numerify('##########'),
        ];
    }
}
