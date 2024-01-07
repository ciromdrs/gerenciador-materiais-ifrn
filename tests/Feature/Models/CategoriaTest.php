<?php

namespace Tests\Feature;

use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa se cria uma categoria.
     */
    public function test_cria_categoria(): void
    {
        $cat = Categoria::factory()->create();
        $this->assertModelExists($cat);
    }

        
    /**
     * Testa se altera uma categoria.
     */
    public function test_altera_categoria(): void
    {
        $cat = Categoria::factory()->create();

        $novo_nome = 'Minha Categoria';
        $cat->nome = $novo_nome;
        $cat->save();

        $this->assertDatabaseHas('categorias', [
            'nome' => $novo_nome
        ]);
    }


    /**
     * Testa se apaga uma categoria.
     */
    public function test_apaga_categoria(): void
    {
        $cat = Categoria::factory()->create();

        $cat->delete();

        $this->assertModelMissing($cat);
    }
}
