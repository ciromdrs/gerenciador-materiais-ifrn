<?php

namespace Tests\Feature\Models;

use App\Models\Local;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
     * Testa se adiciona um item.
     */
    public function test_adiciona_item(): void
    {
        $item = Item::factory()->create();
        $local = Local::factory()->create();

        $local->itens()->save($item);

        // Verifica se o local no banco tem o item
        $local_no_banco = Local::find($local->id);
        $this->assertCount(1, $local_no_banco->itens);
        $this->assertEquals($local_no_banco->itens[0]->id, $item->id);
    }
}
