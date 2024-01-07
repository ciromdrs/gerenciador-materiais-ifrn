<?php

namespace Tests\Feature\Models;

use App\Models\Item;
use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MaterialTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=CategoriaSeeder');
        $this->artisan('db:seed --class=LocalSeeder');
    }


    /**
     * Testa se cria um material.
     */
    public function test_cria_material(): void
    {
        $material = Material::factory()->create();
        $this->assertModelExists($material);
    }

        
    /**
     * Testa se altera um material.
     */
    public function test_altera_material(): void
    {
        $material = Material::factory()->create();

        $novo_nome = 'Meu Material';
        $material->nome = $novo_nome;
        $material->save();

        $this->assertDatabaseHas('materiais', [
            'nome' => $novo_nome
        ]);
    }


    /**
     * Testa se apaga um material.
     */
    public function test_apaga_material(): void
    {
        $material = Material::factory()->create();

        $material->delete();

        $this->assertModelMissing($material);
    }


    /**
     * Testa se adiciona um item.
     */
    public function test_adiciona_item(): void
    {
        $material = Material::factory()->create();
        $total = count($material->itens);
        
        $item = Item::factory()->create(['material_id' => $material->id]);

        // Verifica se o material no banco tem o item
        $material_no_banco = Material::find($material->id);
        $this->assertCount($total + 1, $material_no_banco->itens);
        $this->assertEquals($material_no_banco->itens[0]->id, $item->id);
    }


    /**
     * Testa se remove um item.
     */
    public function test_remove_item(): void
    {
        $material = Material::factory()->create();
        Item::factory()->create(['material_id' => $material->id]);
        $total = count($material->itens);

        $material->itens()->first()->delete();

        // Verifica se o material no banco tem o item
        $material_no_banco = Material::find($material->id);
        $this->assertCount($total - 1, $material_no_banco->itens);
    }
}
