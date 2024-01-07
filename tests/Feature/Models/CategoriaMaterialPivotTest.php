<?php

namespace Tests\Feature\Models;

use App\Models\Material;
use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\TestCase;
/**
 * @covers App\Models\Material::categorias
 * @covers App\Models\Categoria::materiais
 */
class CategoriaMaterialPivotTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa se cria um relacionamento Categoria x Material.
     */
    public function test_cria_relacionamento_categoria_material(): void
    {
        /* Arranjo */
        $material = Material::factory()->create();
        $categoria = Categoria::factory()->create();

        /* Ação */
        $material->categorias()->attach($categoria->id);
        
        /* Asserções */
        // Verifica se criou o pivot do relacionamento
        $this->assertDatabaseHas(
            'categoria_material',
            [
                'material_id' => $material->id,
                'categoria_id' => $categoria->id,
            ]
        );

        // Verifica se o material no banco tem a categoria
        $material_no_banco = Material::find($material->id);
        $this->assertCount(1, $material_no_banco->categorias);
        
        // Verifica se a categoria no banco tem o material
        $categoria_no_banco = Categoria::find($categoria->id);
        $this->assertCount(1, $categoria_no_banco->materiais);
    }

    /**
     * Testa se apaga um relacionamento Categoria x Material.
     */
    public function test_apaga_relacionamento_categoria_material(): void
    {
        /* Arranjo */
        $material = Material::factory()->create();
        $categoria = Categoria::factory()->create();
        $material->categorias()->attach($categoria->id);

        /* Ação */
        $material->categorias()->detach($categoria->id);
        
        /* Asserções */
        // Verifica se apagou o pivot do relacionamento
        $this->assertDatabaseMissing(
            'categoria_material',
            [
                'material_id' => $material->id,
                'categoria_id' => $categoria->id,
            ]
        );

        // Verifica se o material no banco não tem mais a categoria
        $material_no_banco = Material::find($material->id);
        $this->assertCount(0, $material_no_banco->categorias);
        
        // Verifica se a categoria no banco não tem mais o material
        $categoria_no_banco = Categoria::find($categoria->id);
        $this->assertCount(0, $categoria_no_banco->materiais);
    }
}
