<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Place as Local;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\TestCase;

#[CoversClass('\App\Http\Controllers\PlaceController')]
class LocalControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=LocalSeeder');
        $this->artisan('db:seed --class=SessionSeeder');
    }

    /**
     * TODO: Testar se exibe a lista de locais.
     */
    public function TODO_test_LocalController_index(): void
    {
        $response = $this->withCookies(['suapToken' => 'token-falso'])
            ->get(route('locais.index'));

        $response->assertStatus(200);
        # TODO: $response->assertSee('Basquete');
    }

    /**
     * Testar se exibe a página de criação.
     */
    public function test_LocalController_create(): void
    {
        $response = $this->withCookies(['suapToken' => 'token-falso'])
            ->get(route('locais.create'));

        $response->assertStatus(200);
        $response->assertSee('_token'); # Verificar se tem proteção CSRF
    }

    /**
     * TODO: Testar se exibe a página de edição.
     */
    public function TODO_test_LocalController_edit(): void
    {
        $local = Local::first();

        $response = $this
            ->withCookies(['suapToken' => 'token-falso'])
            ->get(route('locais.edit', $local));

        $response->assertStatus(200);
        $response->assertSee('_token'); # Verificar se tem proteção CSRF
    }

    /**
     * TODO: Testar se deleta um local.
     */
    public function TODO_test_LocalController_delete(): void
    {
        $local = Local::first();
        $total = Local::count();

        $this->withCookies(['suapToken' => 'token-falso'])
            ->get(route('locais.delete', $local));

        $this->assertModelMissing($local);
        $this->assertDatabaseCount('places', $total - 1);
    }

    /**
     * TODO: Testar se atualiza um local.
     */
    public function TODO_test_LocalController_update(): void
    {
        $local = Local::first();

        $dados = ['name' => 'novo_nome'];
        $this->withCookies(['suapToken' => 'token-falso'])
            ->patch(route('locais.update', $local), $dados);

        $this->assertDatabaseHas('places', $dados);
    }

    /**
     * Testar se cria um local.
     */
    public function test_LocalController_store(): void
    {
        $dados = ['name' => 'Novo Local'];
        $total = Local::count();

        $this->withCookies(['suapToken' => 'token-falso'])
            ->post(route('locais.store'), $dados);
            
        $this->assertDatabaseHas('places', $dados);
        $this->assertDatabaseCount('places', $total + 1);
    }
}
