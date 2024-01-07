<?php

namespace Tests\Feature\Controllers;

use \App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\TestCase;

#[CoversClass('\App\Http\Controllers\CategoriaController')]
class CategoriaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=CategoriaSeeder');
        $this->artisan('db:seed --class=SessionSeeder');
    }

    /**
     * Testar se exibe a lista de categorias.
     */
    public function test_CategoriaController_index(): void
    {
        $response = $this->withCookies(['suapToken' => 'token-falso'])
            ->get(route('categorias.index'));

        $response->assertStatus(200);
        # TODO: $response->assertSee('Basquete');
    }

    /**
     * Testar se exibe a página de criação.
     */
    public function test_CategoriaController_create(): void
    {
        $response = $this->withCookies(['suapToken' => 'token-falso'])
            ->get(route('categorias.create'));

        $response->assertStatus(200);
        $response->assertSee('_token'); # Verificar se tem proteção CSRF
    }

    /**
     * Testar se exibe a página de edição.
     */
    public function test_CategoriaController_edit(): void
    {
        $categoria = Categoria::first();

        $response = $this
            ->withCookies(['suapToken' => 'token-falso'])
            ->get(route('categorias.editar', $categoria));

        $response->assertStatus(200);
        $response->assertSee('_token'); # Verificar se tem proteção CSRF
    }

    /**
     * Testar se deleta uma categoria.
     */
    public function test_CategoriaController_delete(): void
    {
        $categoria = Categoria::first();
        $total = Categoria::count();

        $this->withCookies(['suapToken' => 'token-falso'])
            ->get(route('categorias.delete', $categoria));

        $this->assertModelMissing($categoria);
        $this->assertDatabaseCount('categorias', $total - 1);
    }

    /**
     * Testar se atualiza uma categoria.
     */
    public function test_CategoriaController_update(): void
    {
        $categoria = Categoria::first();

        $dados = ['nome_categoria' => 'novo_nome'];

        $this->withCookies(['suapToken' => 'token-falso'])
            ->patch(route('categorias.atualizar', $categoria), $dados);

        $this->assertDatabaseHas('categorias', [
            'nome' => $dados['nome_categoria']
        ]);
    }

    /**
     * Testar se cria uma categoria.
     */
    public function test_CategoriaController_store(): void
    {
        $dados = ['nome_categoria' => 'Minha nova categoria'];
        $total = Categoria::count();

        $this->withCookies(['suapToken' => 'token-falso'])
            ->post(route('categorias.store'), $dados);
        
        $this->assertDatabaseHas('categorias', [
            'nome' => $dados['nome_categoria']
        ]);
        $this->assertDatabaseCount('categorias', $total + 1);
    }
}
