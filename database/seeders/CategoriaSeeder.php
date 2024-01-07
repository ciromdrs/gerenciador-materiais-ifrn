<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create(['nome'=>'Basquete']);
        Categoria::create(['nome'=>'Futebol']);
        Categoria::create(['nome'=>'Natação']);
        Categoria::create(['nome'=>'Voleibol']);
        Categoria::create(['nome'=>'Medalhas']);
        Categoria::create(['nome'=>'Troféus']);
        Categoria::create(['nome'=>'Fardamento']);
        Categoria::create(['nome'=>'Permanente']);
        Categoria::create(['nome'=>'Consumo']);
        Categoria::create(['nome'=>'Boxe']);
        Categoria::create(['nome'=>'Outros']);
    }
}
