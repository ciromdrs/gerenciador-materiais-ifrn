<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Session>
 */
class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nome = fake()->name();
        $nome_quebrado = explode(' ', $nome);
        return [
            'nome_usual' => $nome,
            'identificacao' => fake()->numerify('#######'),
            'campus' => fake()->word(),
            'email' => fake()->email(),
            'sexo' => fake()->randomElement(['M', 'F']),
            'cpf' => fake()->numerify('#######'),
            'foto'=> '/media/fotos/75x100/' . fake()->bothify('/######.????##-#?.jpg'),
            'data_de_nascimento'=> fake()->date(),
            'email_academico' => fake()->email(),
            'email_google_classroom' => fake()->email(),
            'email_preferencial' => fake()->email(),
            'email_secundario' => fake()->email(),
            'nome' => $nome,
            'nome_registro' => $nome,
            'nome_social' => '',
            'primeiro_nome' => $nome_quebrado[0],
            'tipo_usuario' => fake()->word(),
            'ultimo_nome' => end($nome_quebrado),
        ];
    }
}
