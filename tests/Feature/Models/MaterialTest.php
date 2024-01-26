<?php

namespace Tests\Feature\Models;

use App\Models\Arquivo;
use App\Models\Categoria;
use App\Models\Local;
use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
     * Testa se salva o local.
     */
    public function test_salva_local(): void
    {
        $local = Local::factory()->create();

        Material::factory()->create(['local_id' => $local->id]);

        $this->assertDatabaseHas('materiais', ['local_id' => $local->id]);
    }

    /**
     * Testa se altera o local.
     */
    public function test_altera_local(): void
    {
        $local1 = Local::factory()->create();
        $local2 = Local::factory()->create();
        $material = Material::factory()->create(['local_id' => $local1->id]);

        $material->local_id = $local2->id;
        $material->save();

        $this->assertDatabaseMissing('materiais', ['local_id' => $local1->id]);
        $this->assertDatabaseHas('materiais', ['local_id' => $local2->id]);
    }

    /**
     * Testa se associa o material ao arquivo da foto.
     */
    public function test_salva_arquivo(): void
    {
        $material = Material::factory()->create();
        $caminho = 'um/caminho/qualquer';

        $arquivo = Arquivo::create([
            'material_id' => $material->id,
            'caminho' => $caminho,
        ]);

        $this->assertEquals($material->arquivo->id, $arquivo->id);
    }

    /**
     * Testa se salva as categorias.
     */
    public function test_salva_categorias(): void
    {
        $cat1 = Categoria::factory()->create();
        $cat2 = Categoria::factory()->create();
        $material = Material::factory()->create();

        $material->categorias()->attach([$cat1->id, $cat2->id]);
        
        $this->assertCount(2, $material->categorias);
        $this->assertCount(1, $cat1->materiais);
        $this->assertCount(1, $cat2->materiais);
        $this->assertEquals($cat1->materiais[0]->id, $material->id);
        $this->assertEquals($cat2->materiais[0]->id, $material->id);
    }
}