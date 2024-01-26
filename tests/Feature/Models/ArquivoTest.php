<?php

namespace Tests\Feature\Models;

use App\Models\Arquivo;
use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @covers App\Models\Arquivo
 */
class ArquivoTest extends TestCase
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
     * Testa se cria um Arquivo.
     */
    public function test_create(): void
    {
        $material_id = Material::first()->id;
        $caminho = 'um/caminho/qualquer';
        $arquivo = Arquivo::create([
            'material_id' => $material_id,
            'caminho' => $caminho,
        ]);
        $this->assertModelExists($arquivo);
        $this->assertEquals($material_id, $arquivo->material->id);
    }
}
