<?php

namespace Tests\Feature\Models;

use App\Enums\EstadoConservacaoEnum;
use App\Models\Arquivo;
use App\Models\Categoria;
use App\Models\Emprestimo;
use App\Models\Local;
use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @covers App\Models\Material
 */
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

        $material = Material::factory()->create(['local_id' => $local->id]);

        $this->assertDatabaseHas('materiais', ['local_id' => $local->id]);
        $this->assertEquals($local->id, $material->local->id);
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

    /**
     * Testa a disponibilidade de um Material disponível.
     */
    public function test_disponivel(): void
    {
        $mat = Material::factory()->create([
            'estado_conservacao' => EstadoConservacaoEnum::EmBomEstado->value
        ]);

        [$disponivel, $motivo] = $mat->disponivel();

        $this->assertTrue($disponivel);
        $this->assertEmpty($motivo);
    }

    /**
     * Testa a disponibilidade de um Material em manutenção.
     */
    public function test_indisponivel_em_manutencao(): void
    {
        $mat = Material::factory()->create([
            'estado_conservacao' => EstadoConservacaoEnum::EmManutencao->value
        ]);

        [$disponivel, $motivo] = $mat->disponivel();

        $this->assertFalse($disponivel);
        $this->assertStringContainsStringIgnoringCase('manuten', $motivo);
    }

    /**
     * Testa a disponibilidade de um Material em danificado.
     */
    public function test_indisponivel_danificado(): void
    {
        $mat = Material::factory()->create([
            'estado_conservacao' => EstadoConservacaoEnum::Danificado->value
        ]);

        [$disponivel, $motivo] = $mat->disponivel();

        $this->assertFalse($disponivel);
        $this->assertStringContainsStringIgnoringCase('danificado', $motivo);
    }

    /**
     * Testa a disponibilidade de um Material emprestado.
     */
    public function test_indisponivel_emprestado(): void
    {
        $mat = Material::factory()->create([
            'estado_conservacao' => EstadoConservacaoEnum::EmBomEstado->value
        ]);
        $emp = Emprestimo::create([
            'usuario_que_emprestou' => 123,
            'usuario_que_recebeu' => 456,
            'usuario_que_devolveu' => 789,
        ]);
        $emp->materiais()->attach($mat);
        
        [$disponivel, $motivo] = $mat->disponivel();

        $this->assertFalse($disponivel);
        $this->assertStringContainsStringIgnoringCase('emprestado', $motivo);
    }
}