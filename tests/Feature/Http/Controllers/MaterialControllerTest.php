<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Material;
use App\Models\Local;
use PHPUnit\Framework\Attributes\CoversClass;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

#[CoversClass('\App\Http\Controllers\MaterialController')]
class MaterialControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=CategoriaSeeder');
        $this->artisan('db:seed --class=LocalSeeder');
        $this->artisan('db:seed --class=MaterialSeeder');
        $this->artisan('db:seed --class=SessionSeeder');
    }

    /**
     * Testar se exibe a lista de materiais.
     */
    public function test_index(): void
    {
        $response = $this->withCookies(['suapToken' => 'token-falso'])
            ->get(route('materiais.index'));

        $response->assertStatus(200);
    }

    /**
     * Testar se exibe a página de criação.
     */
    public function test_create(): void
    {
        $response = $this->withCookies(['suapToken' => 'token-falso'])
            ->get(route('materiais.novo'));

        $response->assertStatus(200);
        $response->assertSee('_token'); # Verificar se tem proteção CSRF
    }

    /**
     * Testar se exibe a página de edição.
     */
    public function test_edit(): void
    {
        $material = Material::first();

        $response = $this
            ->withCookies(['suapToken' => 'token-falso'])
            ->get(route('materiais.editar', $material));

        $response->assertStatus(200);
        $response->assertSee('_token'); # Verificar se tem proteção CSRF
    }

    /**
     * Testar se deleta um material.
     */
    public function test_destroy(): void
    {
        $material = Material::first();
        $total = Material::count();

        $this->withCookies(['suapToken' => 'token-falso'])
            ->get(route('materiais.destroy', $material));

        $this->assertModelMissing($material);
        $this->assertDatabaseCount('materiais', $total - 1);
    }

    /**
     * Testar se atualiza um material.
     */
    public function test_update(): void
    {
        $material = Material::first();

        $dados = [
            'nome' => 'novo_nome',
            'local_id' => $material->local_id,
            'estado_conservacao' => $material->estado_conservacao,
        ];
        $this->withCookies(['suapToken' => 'token-falso'])
            ->post(route('materiais.atualizar', $material), $dados);

        $this->assertDatabaseHas('materiais', $dados);
    }

    /**
     * Testar se cria um material.
     */
    public function test_store(): void
    {
        $local_id = Local::first()->id;

        $dados = [
            'nome' => 'Novo Material',
            'estado_conservacao' => 'bom estado',
            'local_id' => $local_id,
        ];
        $total = Material::count();

        $this->withCookies(['suapToken' => 'token-falso'])
            ->post(route('materiais.salvar'), $dados);
            
        $this->assertDatabaseHas('materiais', $dados);
        $this->assertDatabaseCount('materiais', $total + 1);
    }
}
