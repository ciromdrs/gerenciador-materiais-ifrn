<?php

namespace Tests\Feature\Models;

use App\Models\Local;
use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocalTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=CategoriaSeeder');
        $this->artisan('db:seed --class=LocalSeeder');
        $this->artisan('db:seed --class=MaterialSeeder');
    }

    /**
     * Testa se cria um local.
     */
    public function test_cria_local(): void
    {
        $local = Local::factory()->create();
        $this->assertModelExists($local);
    }

        
    /**
     * Testa se altera um local.
     */
    public function test_altera_local(): void
    {
        $local = Local::factory()->create();

        $novo_nome = 'Meu Local';
        $local->nome = $novo_nome;
        $local->save();

        $this->assertDatabaseHas('locais', [
            'nome' => $novo_nome
        ]);
    }


    /**
     * Testa se apaga um local.
     */
    public function test_apaga_local(): void
    {
        $local = Local::factory()->create();

        $local->delete();

        $this->assertModelMissing($local);
    }

    /**
     * Testa se adiciona um material.
     */
    public function test_adiciona_material(): void
    {
        $local = Local::factory()->create();
        $total = count($local->materiais);
        
        $material = Material::factory()->create(['local_id' => $local->id]);

        // Verifica se o local no banco tem o material
        $local_no_banco = Local::find($local->id);
        $this->assertCount($total + 1, $local_no_banco->materiais);
        $this->assertEquals($local_no_banco->materiais[0]->id, $material->id);
    }

    /**
     * Testa se remove um material.
     */
    public function test_remove_material(): void
    {
        $local = Local::factory()->create();
        Material::factory()->create(['local_id' => $local->id]);
        $total = count($local->materiais);

        $local->materiais()->first()->delete();

        // Verifica se o local no banco tem o material
        $local_no_banco = Local::find($local->id);
        $this->assertCount($total - 1, $local_no_banco->materiais);
    }
}
