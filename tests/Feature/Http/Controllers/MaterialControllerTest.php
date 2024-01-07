<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Material;
use PHPUnit\Framework\Attributes\CoversClass;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

#[CoversClass('\App\Http\Controllers\MaterialController')]
class MaterialControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

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
     * TODO: Testar se exibe a página de edição.
     */
    public function test_edit(): void
    {
        $this->markTestSkipped('Funcionalidade ainda não implementada.');
        $material = Material::first();

        $response = $this
            ->withCookies(['suapToken' => 'token-falso'])
            ->get(route('materiais.edit', $material));

        $response->assertStatus(200);
        $response->assertSee('_token'); # Verificar se tem proteção CSRF
    }

    /**
     * TODO: Testar se deleta um material.
     */
    public function test_delete(): void
    {
        $this->markTestSkipped('Funcionalidade ainda não implementada.');
        $material = Material::first();
        $total = Material::count();

        $this->withCookies(['suapToken' => 'token-falso'])
            ->get(route('materiais.delete', $material));

        $this->assertModelMissing($material);
        $this->assertDatabaseCount('materiais', $total - 1);
    }

    /**
     * TODO: Testar se atualiza um material.
     */
    public function test_update(): void
    {
        $this->markTestSkipped('Funcionalidade ainda não implementada.');
        $material = Material::first();

        $dados = ['nome' => 'novo_nome'];
        $this->withCookies(['suapToken' => 'token-falso'])
            ->patch(route('materiais.update', $material), $dados);

        $this->assertDatabaseHas('materiais', $dados);
    }

    /**
     * Testar se cria um material.
     */
    public function test_store(): void
    {
        $dados = ['nome' => 'Novo Material'];
        $total = Material::count();

        $this->withCookies(['suapToken' => 'token-falso'])
            ->post(route('materiais.salvar'), $dados);
            
        $this->assertDatabaseHas('materiais', $dados);
        $this->assertDatabaseCount('materiais', $total + 1);
    }
}
