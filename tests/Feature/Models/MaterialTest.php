<?php

namespace Tests\Feature\Models;

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

}
