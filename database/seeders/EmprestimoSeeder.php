<?php

namespace Database\Seeders;

use App\Models\Emprestimo;
use App\Models\Material;
use Illuminate\Database\Seeder;

class EmprestimoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emp = Emprestimo::factory()->create();
        
        # Seleciona alguns Materiais aleatoriamente
        $materiais = fake()->randomElements(Material::all());
        for ($i = 0; $i < 3; $i++) {
            foreach ($materiais as $mat) {
                $disp = $mat->disponivel()[0];
                if ($disp) {
                    $emp->materiais()->attach($mat);
                }
            }
        }
    }
}
