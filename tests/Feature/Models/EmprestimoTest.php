<?php

namespace Tests\Feature\Models;

use App\Models\Emprestimo;
use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmprestimoTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=CategoriaSeeder');
        $this->artisan('db:seed --class=LocalSeeder');
        $this->artisan('db:seed --class=MaterialSeeder');
        $this->artisan('db:seed --class=EmprestimoSeeder');
    }


    /**
     * Testa se cria um emprestimo.
     */
    public function test_cria(): void
    {
        $emp = Emprestimo::factory()->create();
        $this->assertModelExists($emp);
    }


    /**
     * Testa se altera um emprestimo.
     */
    public function test_altera(): void
    {
        $emp = Emprestimo::factory()->create([
            'usuario_que_emprestou' => 123,
            'usuario_que_recebeu' => 456,
            'usuario_que_devolveu' => 789,
        ]);
        # Cria 3 materiais
        $materiais = Material::factory(3)->create();
        # Adiciona apenas 2
        $emp->materiais()->attach($materiais[0]);
        $emp->materiais()->attach($materiais[1]);

        $emp->usuario_que_emprestou = 234;
        $emp->usuario_que_recebeu = 567;
        $emp->usuario_que_devolveu = 890;
        $emp->save();
        # Substitui um dos materiais
        $emp->materiais()->detach($materiais[1]);
        $emp->materiais()->attach($materiais[2]);

        $this->assertDatabaseHas('emprestimos', [
            'usuario_que_emprestou' => 234,
            'usuario_que_recebeu' => 567,
            'usuario_que_devolveu' => 890,
        ]);
        $this->assertCount(2, $emp->materiais);
        $this->assertEquals($materiais[0]->id, $emp->materiais[0]->id);
        $this->assertEquals($materiais[2]->id, $emp->materiais[1]->id);
    }


    /**
     * Testa se apaga um emprestimo.
     */
    public function test_apaga(): void
    {
        $emp = Emprestimo::first();

        $emp->materiais()->detach();
        $emp->delete();

        $this->assertModelMissing($emp);
    }

    /**
     * Testa se não apaga um emprestimo com materiais associados.
     */
    public function test_nao_apaga_com_materiais(): void
    {
        $emp = Emprestimo::create();
        $materiais = Material::factory(3)->create();
        $emp->materiais()->attach($materiais);

        $this->expectException('\Illuminate\Database\QueryException');

        $emp->delete();
    }
}
